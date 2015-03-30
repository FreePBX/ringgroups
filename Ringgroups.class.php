<?php
namespace FreePBX\modules;
class Ringgroups implements \BMO {
	public function __construct($freepbx = null) {
		if ($freepbx == null) {
			throw new Exception("Not given a FreePBX Object");
		}
		$this->FreePBX = $freepbx;
		$this->db = $freepbx->Database;
	}
    public function install() {}
    public function uninstall() {}
    public function backup() {}
    public function restore($backup) {}
    public function doConfigPageInit($page) {
    	$request = $_REQUEST;
		isset($request['action'])?$action = $request['action']:$action='';
		//the extension we are currently displaying
		isset($request['extdisplay'])?$extdisplay=$request['extdisplay']:$extdisplay='';
		isset($request['account'])?$account = $request['account']:$account='';
		isset($request['grptime'])?$grptime = $request['grptime']:$grptime='';
		isset($request['grppre'])?$grppre = $request['grppre']:$grppre='';
		isset($request['strategy'])?$strategy = $request['strategy']:$strategy='';
		isset($request['annmsg_id'])?$annmsg_id = $request['annmsg_id']:$annmsg_id='';
		isset($request['description'])?$description = $request['description']:$description='';
		isset($request['alertinfo'])?$alertinfo = $request['alertinfo']:$alertinfo='';
		isset($request['needsconf'])?$needsconf = $request['needsconf']:$needsconf='';
		isset($request['cwignore'])?$cwignore = $request['cwignore']:$cwignore='';
		isset($request['cpickup'])?$cpickup = $request['cpickup']:$cpickup='';
		isset($request['cfignore'])?$cfignore = $request['cfignore']:$cfignore='';
		isset($request['remotealert_id'])?$remotealert_id = $request['remotealert_id']:$remotealert_id='';
		isset($request['toolate_id'])?$toolate_id = $request['toolate_id']:$toolate_id='';
		isset($request['ringing'])?$ringing = $request['ringing']:$ringing='';

		isset($request['changecid'])?$changecid = $request['changecid']:$changecid='default';
		isset($request['fixedcid'])?$fixedcid = $request['fixedcid']:$fixedcid='';
		isset($request['recording'])?$recording = $request['recording']:$recording='dontcare';
		debug($request[$request['goto0']."0"]);
		if (isset($request['goto0']) && isset($request[$request['goto0']."0"])) {
						$goto = $request[$request['goto0']."0"];
		} else {
						$goto = '';
		}


		if (isset($request["grplist"])) {
			$grplist = explode("\n",$request["grplist"]);

			if (!$grplist) {
				$grplist = null;
			}

			foreach (array_keys($grplist) as $key) {
				//trim it
				$grplist[$key] = trim($grplist[$key]);

				// remove invalid chars
				$grplist[$key] = preg_replace("/[^0-9#*]/", "", $grplist[$key]);

				if ($grplist[$key] == ltrim($extdisplay,'GRP-').'#')
					$grplist[$key] = rtrim($grplist[$key],'#');

				// remove blanks
				if ($grplist[$key] == "") unset($grplist[$key]);
			}

			// check for duplicates, and re-sequence
			$grplist = array_values(array_unique($grplist));
		}

		// do if we are submitting a form
		if(isset($request['action'])){
			//check if the extension is within range for this user
			if (isset($account) && !checkRange($account)){
				echo "<script>javascript:alert('". _("Warning! Extension")." ".$account." "._("is not allowed for your account").".');</script>";
			} else {
				//add group
				if ($action == 'addGRP') {

					$conflict_url = array();
					$usage_arr = framework_check_extension_usage($account);
					if (!empty($usage_arr)) {
						$conflict_url = framework_display_extension_usage_alert($usage_arr);

					} elseif (ringgroups_add($account,$strategy,$grptime,implode("-",$grplist),$goto,$description,$grppre,$annmsg_id,$alertinfo,$needsconf,$remotealert_id,$toolate_id,$ringing,$cwignore,$cfignore,$changecid,$fixedcid,$cpickup,$recording)) {

						// save the most recent created destination which will be picked up by
						//
						$this_dest = ringgroups_getdest($account);
						\fwmsg::set_dest($this_dest[0]);
						needreload();
					}
				}

				//del group
				if ($action == 'delGRP') {
					ringgroups_del($account);
					needreload();
					unset($_REQUEST['view']);
					unset($_REQUEST['extdisplay']);
				}

				//edit group - just delete and then re-add the extension
				if ($action == 'edtGRP') {
					ringgroups_del($account);
					ringgroups_add($account,$strategy,$grptime,implode("-",$grplist),$goto,$description,$grppre,$annmsg_id,$alertinfo,$needsconf,$remotealert_id,$toolate_id,$ringing,$cwignore,$cfignore,$changecid,$fixedcid,$cpickup,$recording);
					needreload();
				}
			}
		}
    }
	public function getActionBar($request){
		switch($request['display']){
			case 'ringgroups':
				$buttons = array(
					'delete' => array(
						'name' => 'delete',
						'id' => 'delete',
						'value' => _('Delete')
					),
					'submit' => array(
						'name' => 'submit',
						'id' => 'submit',
						'value' => _('Submit')
					),
					'reset' => array(
						'name' => 'reset',
						'id' => 'reset',
						'value' => _('Reset')
					)
    			);
    		break;
    	}
    	if (empty($request['extdisplay'])) {
    		unset($buttons['delete']);
    	}
    	if($request['view'] != 'form'){
    		unset($buttons);
    	}
    	return $buttons;
    }    
}