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

function ringgroups_getdest($exten) {
	return array("ext-group,$exten,1");
}

function ringgroups_getdestinfo($dest) {
	if (substr(trim($dest),0,10) == 'ext-group,') {
		$grp = explode(',',$dest);
		$grp = $grp[1];
		$thisgrp = ringgroups_get($grp);
		if (empty($thisgrp)) {
			return array();
		} else {
			return array('description' => 'Ring Group '.$grp.': '.$thisgrp['description'],
			             'edit_url' => 'config.php?display=ringgroups&extdisplay=GRP-'.urlencode($grp),
								  );
		}
	} else {
		return false;
	}
}

function ringgroups_recordings_usage($recording_id) {
	global $active_modules;

	$results = sql("SELECT `grpnum`, `description` FROM `ringgroups` WHERE `annmsg_id` = '$recording_id' OR `remotealert_id` = '$recording_id' OR `toolate_id` = '$recording_id'","getAll",DB_FETCHMODE_ASSOC);
	if (empty($results)) {
		return array();
	} else {
		//$type = isset($active_modules['ivr']['type'])?$active_modules['ivr']['type']:'setup';
		foreach ($results as $result) {
			$usage_arr[] = array(
				'url_query' => 'config.php?display=ringgroups&extdisplay=GRP-'.urlencode($result['grpnum']),
				'description' => "Ring Group: ".$result['description'],
			);
		}
		return $usage_arr;
	}
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
			$ringlist = ringgroups_list(true);
			if (is_array($ringlist)) {
				foreach($ringlist as $item) {
					$grpnum = ltrim($item['0']);
					$grp = ringgroups_get($grpnum);
					
					$strategy = $grp['strategy'];
					$grptime = $grp['grptime'];
					$grplist = $grp['grplist'];
					$postdest = $grp['postdest'];
					$grppre = (isset($grp['grppre'])?$grp['grppre']:'');
					$annmsg_id = (isset($grp['annmsg_id'])?$grp['annmsg_id']:'');
					$alertinfo = $grp['alertinfo'];
					$needsconf = $grp['needsconf'];
					$cwignore = $grp['cwignore'];
					$cfignore = $grp['cfignore'];
					$remotealert_id = $grp['remotealert_id'];
					$toolate_id = $grp['toolate_id'];
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
					// but strip only if you plan on setting a new one
					if ($grppre != '') {
						$ext->add($contextname, $grpnum, '', new ext_gotoif('$["foo${RGPREFIX}" = "foo"]', 'REPCID'));
						$ext->add($contextname, $grpnum, '', new ext_gotoif('$["${RGPREFIX}" != "${CALLERID(name):0:${LEN(${RGPREFIX})}}"]', 'REPCID'));
						$ext->add($contextname, $grpnum, '', new ext_noop('Current RGPREFIX is ${RGPREFIX}....stripping from Caller ID'));
						$ext->add($contextname, $grpnum, '', new ext_setvar('CALLERID(name)', '${CALLERID(name):${LEN(${RGPREFIX})}}'));
						$ext->add($contextname, $grpnum, '', new ext_setvar('_RGPREFIX', ''));
						$ext->add($contextname, $grpnum, 'REPCID', new ext_noop('CALLERID(name) is ${CALLERID(name)}'));
						$ext->add($contextname, $grpnum, '', new ext_setvar('_RGPREFIX', $grppre));
						$ext->add($contextname, $grpnum, '', new ext_setvar('CALLERID(name)','${RGPREFIX}${CALLERID(name)}'));
					}
					
					// Set Alert_Info
					if ($alertinfo != '') {
						$ext->add($contextname, $grpnum, '', new ext_setvar('__ALERT_INFO', str_replace(';', '\;', $alertinfo)));
					}
					if ($cwignore != '') {
 						$ext->add($contextname, $grpnum, '', new ext_setvar('__CWIGNORE', 'TRUE'));
					}
					if ($cwignore != '') {
 						$ext->add($contextname, $grpnum, '', new ext_setvar('_CFIGNORE', 'TRUE'));
 						$ext->add($contextname, $grpnum, '', new ext_setvar('_FORWARD_CONTEXT', 'block-cf'));
					}

					// recording stuff
					$ext->add($contextname, $grpnum, '', new ext_setvar('RecordMethod','Group'));
					$ext->add($contextname, $grpnum, '', new ext_macro('record-enable',$grplist.',${RecordMethod}'));

					// group dial
					$ext->add($contextname, $grpnum, '', new ext_setvar('RingGroupMethod',$strategy));
					if ($annmsg_id) {
						$annmsg = recordings_get_file($annmsg_id);
						$ext->add($contextname, $grpnum, '', new ext_gotoif('$["foo${RRNODEST}" != "foo"]','DIALGRP'));			
						$ext->add($contextname, $grpnum, '', new ext_answer(''));
						$ext->add($contextname, $grpnum, '', new ext_wait(1));
						$ext->add($contextname, $grpnum, '', new ext_playback($annmsg));
					}
					if ($needsconf == "CHECKED") {
						$remotealert = recordings_get_file($remotealert_id);
						$toolate = recordings_get_file($toolate_id);
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

function ringgroups_add($grpnum,$strategy,$grptime,$grplist,$postdest,$desc,$grppre='',$annmsg_id='',$alertinfo,$needsconf,$remotealert_id,$toolate_id,$ringing,$cwignore,$cfignore) {
	global $db;

	$extens = ringgroups_list();
	if(is_array($extens)) {
		foreach($extens as $exten) {
			if ($exten[0]===$grpnum) {
				echo "<script>javascript:alert('"._("This ringgroup")." ({$grpnum}) "._("is already in use")."');</script>";
				return false;
			}
		}
	}
	print_r($extens);

	$sql = "INSERT INTO ringgroups (grpnum, strategy, grptime, grppre, grplist, annmsg_id, postdest, description, alertinfo, needsconf, remotealert_id, toolate_id, ringing, cwignore, cfignore) VALUES ('".$db->escapeSimple($grpnum)."', '".$db->escapeSimple($strategy)."', ".$db->escapeSimple($grptime).", '".$db->escapeSimple($grppre)."', '".$db->escapeSimple($grplist)."', '".$annmsg_id."', '".$db->escapeSimple($postdest)."', '".$db->escapeSimple($desc)."', '".$db->escapeSimple($alertinfo)."', '$needsconf', '$remotealert_id', '$toolate_id', '$ringing', '$cwignore', '$cfignore')";
	$results = sql($sql);
	return true;
}

function ringgroups_del($grpnum) {
	global $db;

	$results = sql("DELETE FROM ringgroups WHERE grpnum = '".$db->escapeSimple($grpnum)."'","query");
}

function ringgroups_list($get_all=false) {
	$results = sql("SELECT grpnum, description FROM ringgroups ORDER BY CAST(grpnum as UNSIGNED)","getAll",DB_FETCHMODE_ASSOC);
	foreach ($results as $result) {
		if ($get_all || (isset($result['grpnum']) && checkRange($result['grpnum']))) {
			$grps[] = array(
				0 => $result['grpnum'], 
				1 => $result['description'],
				'grpnum' => $result['grpnum'], 
				'description' => $result['description'],
			);
		}
	}
	if (isset($grps))
		return $grps;
	else
		return array();
}

function ringgroups_check_extensions($exten=true) {
	$extenlist = array();
	if (is_array($exten) && empty($exten)) {
		return $extenlist;
	}
	$sql = "SELECT grpnum ,description FROM ringgroups ";
	if (is_array($exten)) {
		$sql .= "WHERE grpnum in ('".implode("','",$exten)."')";
	}
	$results = sql($sql,"getAll",DB_FETCHMODE_ASSOC);

	foreach ($results as $result) {
		$thisexten = $result['grpnum'];
		$extenlist[$thisexten]['description'] = _("Ring Group: ").$result['description'];
		$extenlist[$thisexten]['status'] = 'INUSE';
		$extenlist[$thisexten]['edit_url'] = 'config.php?display=ringgroups&extdisplay=GRP-'.urlencode($thisexten);
	}
	return $extenlist;
}

function ringgroups_check_destinations($dest=true) {
	global $active_modules;

	$destlist = array();
	if (is_array($dest) && empty($dest)) {
		return $destlist;
	}
	$sql = "SELECT grpnum, postdest, description FROM ringgroups ";
	if ($dest !== true) {
		$sql .= "WHERE postdest in ('".implode("','",$dest)."')";
	}
	$results = sql($sql,"getAll",DB_FETCHMODE_ASSOC);

	//$type = isset($active_modules['announcement']['type'])?$active_modules['announcement']['type']:'setup';

	foreach ($results as $result) {
		$thisdest = $result['postdest'];
		$thisid   = $result['grpnum'];
		$destlist[] = array(
			'dest' => $thisdest,
			'description' => 'Ringroup: '.$result['description'].'('.$thisid.')',
			'edit_url' => 'config.php?display=ringgroups&extdisplay=GRP-'.urlencode($thisid),
		);
	}
	return $destlist;
}

function ringgroups_get($grpnum) {
	global $db;

	$results = sql("SELECT grpnum, strategy, grptime, grppre, grplist, annmsg_id, postdest, description, alertinfo, needsconf, remotealert_id, toolate_id, ringing, cwignore, cfignore FROM ringgroups WHERE grpnum = '".$db->escapeSimple($grpnum)."'","getRow",DB_FETCHMODE_ASSOC);
	return $results;
}
?>
