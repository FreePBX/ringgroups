<?php /* $Id$ */

// The destinations this module provides
// returns a associative arrays with keys 'destination' and 'description'
function ringgroups_destinations() {
	//get the list of ringgroups
	$results = ringgroups_list();
	
	// return an associative array with destination and description
	if (isset($results)) {
		foreach($results as $result){
				$thisgrp = ringgroups_get(ltrim($result['0']));
				$extens[] = array('destination' => 'ext-group,'.ltrim($result['0']).',1', 'description' => $thisgrp['description'].' <'.ltrim($result['0']).'>');
		}
	}
	
	if (isset($extens)) 
		return $extens;
	else
		return null;
}

/* 	Generates dialplan for ringgroups
	We call this with retrieve_conf
*/
function ringgroups_get_config($engine) {
	global $ext;  // is this the best way to pass this?
	switch($engine) {
		case "asterisk":
			$ext->addInclude('from-internal-additional','ext-group');
			$ext->addInclude('from-internal-additional','grps');
			$contextname = 'ext-group';
			$ringlist = ringgroups_list();
			if (is_array($ringlist)) {
				foreach($ringlist as $item) {
					$grpnum = ltrim($item['0']);
					$grp = ringgroups_get($grpnum);
					
					$strategy = $grp['strategy'];
					$grptime = $grp['grptime'];
					$grplist = $grp['grplist'];
					$postdest = $grp['postdest'];
					$grppre = (isset($grp['grppre'])?$grp['grppre']:'');
					$annmsg = (isset($grp['annmsg'])?$grp['annmsg']:'');
					$alertinfo = $grp['alertinfo'];
					$needsconf = $grp['needsconf'];
					$remotealert = $grp['remotealert'];
					$toolate = $grp['toolate'];
					$ringing = $grp['ringing'];

					if($ringing == 'Ring' || empty($ringing) ) {
						$dialopts = '${DIAL_OPTIONS}';
					} else {
						// We need the DIAL_OPTIONS variable
						$sops = sql("SELECT value from globals where variable='DIAL_OPTIONS'", "getRow");
						$dialopts = "m(${ringing})".str_replace('r', '', $sops[0]);
					}
						

					$ext->add($contextname, $grpnum, '', new ext_macro('user-callerid'));

					// block voicemail until phone is answered at which point a macro should be called on the answering
					// line to clear this flag so that subsequent transfers can occur, if already set by a the caller
					// then don't change.
					//
					$ext->add($contextname, $grpnum, '', new ext_gotoif('$["foo${BLKVM_OVERRIDE}" = "foo"]', 'skipdb'));
					$ext->add($contextname, $grpnum, '', new ext_gotoif('$["${DB(${BLKVM_OVERRIDE})}" = "TRUE"]', 'skipov'));

					$ext->add($contextname, $grpnum, 'skipdb', new ext_setvar('__NODEST', ''));
					$ext->add($contextname, $grpnum, '', new ext_setvar('__BLKVM_OVERRIDE', 'BLKVM/${EXTEN}/${CHANNEL}'));
					$ext->add($contextname, $grpnum, '', new ext_setvar('__BLKVM_BASE', '${EXTEN}'));
					$ext->add($contextname, $grpnum, '', new ext_setvar('DB(${BLKVM_OVERRIDE})', 'TRUE'));

					// Remember if NODEST was set later, but clear it in case the call is answered so that subsequent
					// transfers work.
					//
					$ext->add($contextname, $grpnum, 'skipov', new ext_setvar('RRNODEST', '${NODEST}'));
					$ext->add($contextname, $grpnum, 'skipvmblk', new ext_setvar('__NODEST', '${EXTEN}'));
					
					// deal with group CID prefix
					$ext->add($contextname, $grpnum, '', new ext_gotoif('$["foo${RGPREFIX}" = "foo"]', 'REPCID'));
					$ext->add($contextname, $grpnum, '', new ext_gotoif('$["${RGPREFIX}" != "${CALLERID(name):0:${LEN(${RGPREFIX})}}"]', 'REPCID'));
					$ext->add($contextname, $grpnum, '', new ext_noop('Current RGPREFIX is ${RGPREFIX}....stripping from Caller ID'));
					$ext->add($contextname, $grpnum, '', new ext_setvar('CALLERID(name)', '${CALLERID(name):${LEN(${RGPREFIX})}}'));
					$ext->add($contextname, $grpnum, '', new ext_setvar('_RGPREFIX', ''));
					$ext->add($contextname, $grpnum, 'REPCID', new ext_noop('CALLERID(name) is ${CALLERID(name)}'));
					if ($grppre != '') {
						$ext->add($contextname, $grpnum, '', new ext_setvar('_RGPREFIX', $grppre));
						$ext->add($contextname, $grpnum, '', new ext_setvar('CALLERID(name)','${RGPREFIX}${CALLERID(name)}'));
					}
					
					// Set Alert_Info
					if ($alertinfo != '') {
						$ext->add($contextname, $grpnum, '', new ext_setvar('__ALERT_INFO', str_replace(';', '\;', $alertinfo)));
					}

					// recording stuff
					$ext->add($contextname, $grpnum, '', new ext_setvar('RecordMethod','Group'));
					$ext->add($contextname, $grpnum, '', new ext_macro('record-enable',$grplist.',${RecordMethod}'));

					// group dial
					$ext->add($contextname, $grpnum, '', new ext_setvar('RingGroupMethod',$strategy));
					if ($annmsg != '') {
						$ext->add($contextname, $grpnum, '', new ext_gotoif('$["foo${RRNODEST}" != "foo"]','DIALGRP'));			
						$ext->add($contextname, $grpnum, '', new ext_answer(''));
						$ext->add($contextname, $grpnum, '', new ext_wait(1));
						$ext->add($contextname, $grpnum, '', new ext_playback($annmsg));
					}
					if ($needsconf == "CHECKED") {
						$len=strlen($grpnum)+4;
						$ext->add("grps", "_RG-${grpnum}-.", '', new ext_macro('dial',$grptime.
							",M(confirm^${remotealert}^${toolate}^${grpnum})$dialopts".',${EXTEN:'.$len.'}'));
						$ext->add($contextname, $grpnum, 'DIALGRP', new ext_macro('dial-confirm',"$grptime,$dialopts,$grplist,$grpnum"));
					} else {
						$ext->add($contextname, $grpnum, 'DIALGRP', new ext_macro('dial',$grptime.",$dialopts,".$grplist));
					}
					$ext->add($contextname, $grpnum, '', new ext_setvar('RingGroupMethod',''));


					// Now if we were told to skip the destination, do so now. Otherwise reset NODEST and proceed to our destination.
					//
					$ext->add($contextname, $grpnum, '', new ext_gotoif('$["foo${RRNODEST}" != "foo"]', 'nodest'));
					$ext->add($contextname, $grpnum, '', new ext_setvar('__NODEST', ''));

					$ext->add($contextname, $grpnum, '', new ext_dbdel('${BLKVM_OVERRIDE}'));

					// where next?
					if ((isset($postdest) ? $postdest : '') != '') {
						$ext->add($contextname, $grpnum, '', new ext_goto($postdest));
					} else {
						$ext->add($contextname, $grpnum, '', new ext_hangup(''));
					}
					$ext->add($contextname, $grpnum, 'nodest', new ext_noop('SKIPPING DEST, CALL CAME FROM Q/RG: ${RRNODEST}'));
				}
			}
		break;
	}
}

function ringgroups_add($grpnum,$strategy,$grptime,$grplist,$postdest,$desc,$grppre='',$annmsg='',$alertinfo,$needsconf,$remotealert,$toolate,$ringing) {
	$sql = "INSERT INTO ringgroups (grpnum, strategy, grptime, grppre, grplist, annmsg, postdest, description, alertinfo, needsconf, remotealert, toolate, ringing) VALUES (".$grpnum.", '".str_replace("'", "''", $strategy)."', ".str_replace("'", "''", $grptime).", '".str_replace("'", "''", $grppre)."', '".str_replace("'", "''", $grplist)."', '".str_replace("'", "''", $annmsg)."', '".str_replace("'", "''", $postdest)."', '".str_replace("'", "''", $desc)."', '".str_replace("'", "''", $alertinfo)."', '$needsconf', '$remotealert', '$toolate', '$ringing')";
	$results = sql($sql);
}

function ringgroups_del($grpnum) {
	$results = sql("DELETE FROM ringgroups WHERE grpnum = $grpnum","query");
}

function ringgroups_list() {
	$results = sql("SELECT grpnum, description FROM ringgroups ORDER BY grpnum","getAll",DB_FETCHMODE_ASSOC);
	foreach ($results as $result) {
		if (isset($result['grpnum']) && checkRange($result['grpnum'])) {
			$grps[] = array($result['grpnum'], $result['description']);
		}
	}
	if (isset($grps))
		return $grps;
	else
		return null;
}

function ringgroups_get($grpnum) {
	$results = sql("SELECT grpnum, strategy, grptime, grppre, grplist, annmsg, postdest, description, alertinfo, needsconf, remotealert, toolate, ringing FROM ringgroups WHERE grpnum = $grpnum","getRow",DB_FETCHMODE_ASSOC);
	return $results;
}
?>
