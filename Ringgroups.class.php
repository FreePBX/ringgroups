<?php
namespace FreePBX\modules;

use BMO;
use FreePBX_Helpers;
use PDO;

class Ringgroups extends FreePBX_Helpers implements BMO {

	public function install() {

		$set          = [];
		$freepbx_conf = \freepbx_conf::create();

		/* EXTENSION_LIST_RINGGROUPS */
		$set['value']       = false;
		$set['defaultval']  = &$set['value'];
		$set['readonly']    = 0;
		$set['hidden']      = 0;
		$set['level']       = 0;
		$set['module']      = 'ringgroups';
		$set['category']    = 'Ring Group Module';
		$set['emptyok']     = 0;
		$set['sortorder']   = 50;
		$set['name']        = 'Display Extension Ring Group Members';
		$set['description'] = 'When set to true extensions that belong to one or more Ring Groups will have a Ring Group section and link back to each group they are a member of.';
		$set['type']        = CONF_TYPE_BOOL;
		$freepbx_conf->define_conf_setting('EXTENSION_LIST_RINGGROUPS', $set, true);


		/*Fix recording status. If it's 'yes' or 'no, it should be 'force' or 'never'. */
		$sql = 'UPDATE `ringgroups` SET `recording`="never" WHERE `recording`="no"';
		$this->Database->query($sql)->execute();
		$sql = 'UPDATE `ringgroups` SET `recording`="force" WHERE `recording`="yes"';
		$this->Database->query($sql)->execute();
	}
	public function uninstall() {
	}

	public function doConfigPageInit($page) {
		$grplist = [];
		$request = $_REQUEST;
		isset($request['action']) ? $action = $request['action'] : $action = '';
		//the extension we are currently displaying
		isset($request['extdisplay']) ? $extdisplay = $request['extdisplay'] : $extdisplay = '';
		isset($request['account']) ? $account = $request['account'] : $account = '';
		isset($request['grptime']) ? $grptime = $request['grptime'] : $grptime = '';
		isset($request['progress']) ? $progress = $request['progress'] : $progress = 'yes';
		isset($request['elsewhere']) ? $elsewhere = $request['elsewhere'] : $elsewhere = 'no';
		isset($request['grppre']) ? $grppre = $request['grppre'] : $grppre = '';
		isset($request['strategy']) ? $strategy = $request['strategy'] : $strategy = '';
		isset($request['annmsg_id']) ? $annmsg_id = $request['annmsg_id'] : $annmsg_id = '';
		isset($request['description']) ? $description = $request['description'] : $description = '';
		isset($request['alertinfo']) ? $alertinfo = $request['alertinfo'] : $alertinfo = '';
		isset($request['needsconf']) ? $needsconf = $request['needsconf'] : $needsconf = '';
		isset($request['cwignore']) ? $cwignore = $request['cwignore'] : $cwignore = '';
		isset($request['cpickup']) ? $cpickup = $request['cpickup'] : $cpickup = '';
		isset($request['cfignore']) ? $cfignore = $request['cfignore'] : $cfignore = '';
		isset($request['remotealert_id']) ? $remotealert_id = $request['remotealert_id'] : $remotealert_id = '0';
		isset($request['toolate_id']) ? $toolate_id = $request['toolate_id'] : $toolate_id = '';
		isset($request['ringing']) ? $ringing = $request['ringing'] : $ringing = '';
		isset($request['rvolume']) ? $rvolume = $request['rvolume'] : $rvolume = '';

		isset($request['changecid']) ? $changecid = $request['changecid'] : $changecid = 'default';
		isset($request['fixedcid']) ? $fixedcid = $request['fixedcid'] : $fixedcid = '';
		isset($request['recording']) ? $recording = $request['recording'] : $recording = 'dontcare';
		if (isset($request['goto0']) && isset($request[$request['goto0'] . "0"])) {
			$goto = $request[$request['goto0'] . "0"];
		}
		else {
			$goto = '';
		}

		if (isset($request["grplist"])) {
			$grplist = explode("\n", (string) $request["grplist"]);

			if (!$grplist) {
				$grplist = null;
			}

			foreach (array_keys($grplist) as $key) {
				//trim it
				$grplist[$key] = trim($grplist[$key]);

				// remove invalid chars
				$grplist[$key] = preg_replace("/[^0-9#*]/", "", $grplist[$key]);

				if ($grplist[$key] == ltrim((string) $extdisplay, 'GRP-') . '#')
					$grplist[$key] = rtrim($grplist[$key], '#');

				// remove blanks
				if ($grplist[$key] == "") unset($grplist[$key]);
			}

			// check for duplicates, and re-sequence
			$grplist = array_values(array_unique($grplist));
		}

		// do if we are submitting a form
		if (isset($request['action'])) {
			//check if the extension is within range for this user
			if (isset($account) && !checkRange($account)) {
				echo "<script>javascript:alert('" . _("Warning! Extension") . " " . $account . " " . _("is not allowed for your account") . ".');</script>";
			}
			else {
				//add group
				if ($action == 'addGRP') {

					$conflict_url = [];
					$usage_arr    = framework_check_extension_usage($account);
					if (!empty($usage_arr)) {
						$conflict_url = framework_display_extension_usage_alert($usage_arr);

					}
					elseif ($this->add($account, $strategy, $grptime, implode("-", $grplist), $goto, $description, $grppre, $annmsg_id, $alertinfo, $needsconf, $remotealert_id, $toolate_id, $ringing, $cwignore, $cfignore, $changecid, $fixedcid, $cpickup, $recording, $progress, $elsewhere, $rvolume)) {

						// save the most recent created destination which will be picked up by
						//
						$this_dest = ringgroups_getdest($account);
						\fwmsg::set_dest($this_dest[0]);
						needreload();
						$_REQUEST['extdisplay'] = $account;
						unset($_REQUEST['view']);
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
					$this->add($account, $strategy, $grptime, implode("-", $grplist), $goto, $description, $grppre, $annmsg_id, $alertinfo, $needsconf, $remotealert_id, $toolate_id, $ringing, $cwignore, $cfignore, $changecid, $fixedcid, $cpickup, $recording, $progress, $elsewhere, $rvolume);
					needreload();
					$_REQUEST['extdisplay'] = $account;
					unset($_REQUEST['view']);
				}
			}
		}
	}

	public function search($query, &$results) {
		if (!ctype_digit((string) $query)) {
			$sql = "SELECT * FROM ringgroups WHERE description LIKE ?";
			$sth = $this->Database->prepare($sql);
			$sth->execute([ "%" . $query . "%" ]);
			$rows = $sth->fetchAll(\PDO::FETCH_ASSOC);
			foreach ($rows as $row) {
				$results[] = [ "text" => _("RingGroup") . " " . $row['grpnum'], "type" => "get", "dest" => "?display=ringgroups&view=form&extdisplay=GRP-" . $row['grpnum'] ];
			}
		}
		else {
			$sql = "SELECT * FROM ringgroups WHERE grpnum LIKE ?";
			$sth = $this->Database->prepare($sql);
			$sth->execute([ "%" . $query . "%" ]);
			$rows = $sth->fetchAll(\PDO::FETCH_ASSOC);
			foreach ($rows as $row) {
				$results[] = [ "text" => $row['description'] . " (" . $row['grpnum'] . ")", "type" => "get", "dest" => "?display=ringgroups&view=form&extdisplay=GRP-" . $row['grpnum'] ];
			}
		}
	}

	public function getActionBar($request) {
		$buttons = [];
		switch ($request['display']) {
			case 'ringgroups':
				$buttons = [ 'delete' => [ 'name' => 'delete', 'id' => 'delete', 'value' => _('Delete') ], 'submit' => [ 'name' => 'submit', 'id' => 'submit', 'value' => _('Submit') ], 'reset' => [ 'name' => 'reset', 'id' => 'reset', 'value' => _('Reset') ] ];
				break;
		}
		if (empty($request['extdisplay'])) {
			unset($buttons['delete']);
		}
		if ($_GET['view'] != 'form') {
			unset($buttons);
		}
		return $buttons;
	}

	public function listRinggroups($get_all = false) {
		$sql  = "SELECT grpnum, description FROM ringgroups ORDER BY CAST(grpnum as UNSIGNED)";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchall(\PDO::FETCH_ASSOC);
		foreach ($results as $result) {
			if ($get_all || (isset($result['grpnum']) && checkRange($result['grpnum']))) {
				$grps[] = [ 0 => $result['grpnum'], 1 => $result['description'], 'grpnum' => $result['grpnum'], 'description' => $result['description'] ];
			}
		}
		return $grps ?? [];
	}

	public function getAllGroups() {
		$sql  = "SELECT * FROM ringgroups ORDER BY CAST(grpnum as UNSIGNED)";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchall(\PDO::FETCH_ASSOC);
		foreach ($results as $result) {
			if (isset($result['grpnum'])) {
				$changecid           = strtolower((string) $this->FreePBX->astman->database_get("RINGGROUP", $result['grpnum'] . "/changecid"));
				$fixedcid            = $this->FreePBX->astman->database_get("RINGGROUP", $result['grpnum'] . "/fixedcid");
				$result['changecid'] = $changecid;
				$result['fixedcid']  = $fixedcid;
				$grps[]              = $result;
			}
		}
		return $grps ?? [];
	}
	public function getExtensionLists($grpnum) {
		$sql = "SELECT grplist FROM ringgroups WHERE grpnum = ?";
		$sth = $this->Database->prepare($sql);
		$sth->execute([ $grpnum ]);
		$rows = $sth->fetch(\PDO::FETCH_ASSOC);
		return $rows;
	}

	public function updateExtensionLists($grpnum, $extensions) {
		$sql = "UPDATE ringgroups SET grplist = ? WHERE grpnum = ?";
		$sth = $this->Database->prepare($sql);
		$sth->execute([ $extensions, $grpnum ]);
	}

	public function ajaxRequest($req, &$setting) {
		return match ($req) {
			'getJSON' => true,
			default => false,
		};
	}

	public function ajaxHandler() {
		return match ($_REQUEST['command']) {
			'getJSON' => match ($_REQUEST['jdata']) {
					'grid' => array_values($this->listRinggroups()),
					default => false,
				},
			default => false,
		};
	}

	public function getRightNav($request) {
		if (isset($request['view']) && $request['view'] == 'form') {
			return load_view(__DIR__ . "/views/bootnav.php", []);
		}
	}
	public function add($grpnum = '', $strategy = '', $grptime = '', $grplist = '', $postdest = '', $desc = '', $grppre = '', $annmsg_id = '0', $alertinfo = '', $needsconf = '', $remotealert_id = '', $toolate_id = '', $ringing = '', $cwignore = '', $cfignore = '', $changecid = 'default', $fixedcid = '', $cpickup = '', $recording = 'dontcare', $progress = 'yes', $elsewhere = '', $rvolume = '', $skipJs = 0) {
		$extens = $this->listRinggroups(false);
		if (is_array($extens)) {
			foreach ($extens as $exten) {
				if ($exten[0] === $grpnum) {
					if ($skipJs == 0) {
						echo "<script>javascript:alert('" . _("This ringgroup") . " ({$grpnum}) " . _("is already in use") . "');</script>";
					}
					return false;
				}
			}
		}

		// Random error that can crop up, so we fix it here, this probably
		// happens if something went wrong with announcements.
		$annmsg_id = (!empty($annmsg_id) && ctype_digit((string) $annmsg_id)) ? $annmsg_id : 0;
		// XXX: Kludge to force to zero if unset or not numeric
		$remotealert_id = (!empty($remotealert_id) && ctype_digit((string) $remotealert_id)) ? $remotealert_id : 0;
		$toolate_id     = (!empty($toolate_id) && ctype_digit((string) $toolate_id)) ? $toolate_id : 0;

		$sql  = "INSERT INTO ringgroups (grpnum, strategy, grptime, grppre, grplist, annmsg_id, postdest, description, alertinfo, needsconf, remotealert_id, toolate_id, ringing, cwignore, cfignore, cpickup, recording, progress, elsewhere, rvolume) VALUES (:grpnum, :strategy, :grptime, :grppre, :grplist, :annmsg_id, :postdest, :desc, :alertinfo, :needsconf, :remotealert_id, :toolate_id, :ringing, :cwignore, :cfignore, :cpickup, :recording, :progress, :elsewhere, :rvolume)";
		$vars = [ ":grpnum" => $grpnum, ":strategy" => $strategy, ":grptime" => $grptime, ":grppre" => $grppre, ":grplist" => $grplist, ":annmsg_id" => $annmsg_id, ":postdest" => $postdest, ":desc" => $desc, ":alertinfo" => $alertinfo, ":needsconf" => $needsconf, ":remotealert_id" => $remotealert_id, ":toolate_id" => $toolate_id, ":ringing" => $ringing, ":cwignore" => $cwignore, ":cfignore" => $cfignore, ":cpickup" => $cpickup, ":recording" => $recording, ":progress" => $progress, ":elsewhere" => $elsewhere, ":rvolume" => $rvolume ];
		$stmt = $this->Database->prepare($sql);
		$stmt->execute($vars);
		if ($this->FreePBX->astman) {
			$this->FreePBX->astman->database_put("RINGGROUP", $grpnum . "/changecid", $changecid);
			$fixedcid = preg_replace("/[^0-9\+]/", "", trim((string) $fixedcid));
			$this->FreePBX->astman->database_put("RINGGROUP", $grpnum . "/fixedcid", $fixedcid);
		}
		else {
			die_freepbx("Cannot connect to Asterisk Manager");
		}
		return true;
	}

	public function delDevice($account, $editmode = false) {
		if (!$editmode) {
			$grouplist = $this->listRinggroups();
			if (isset($grouplist)) {
				foreach ($grouplist as $list => $group) {
					$extensionlist = $this->getExtensionLists($group['grpnum']);
					$extensions    = explode('-', (string) $extensionlist['grplist']);
					$key           = array_search($account, $extensions);
					if ($key !== FALSE) {
						unset($extensions[$key]);
						$new_grplist = implode('-', $extensions);
						$this->updateExtensionLists($group['grpnum'], $new_grplist);
					}
				}
			}
		}
	}

	public function get($grpnum) {
		$sql  = "SELECT grpnum, strategy, grptime, grppre, grplist, annmsg_id, postdest, description, alertinfo, needsconf, remotealert_id, toolate_id, ringing, cwignore, cfignore, cpickup, recording, progress, elsewhere,rvolume FROM ringgroups WHERE grpnum = :grpnum LIMIT 1";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute([ ':grpnum' => $grpnum ]);
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($this->FreePBX->astman->connected()) {
			$astdb_changecid = strtolower((string) $this->FreePBX->astman->database_get("RINGGROUP", $grpnum . "/changecid"));
			switch ($astdb_changecid) {
				case 'default':
				case 'did':
				case 'forcedid':
				case 'fixed':
				case 'extern':
					break;
				default:
					$astdb_changecid = 'default';
			}
			$results['changecid'] = $astdb_changecid;
			$fixedcid             = $this->FreePBX->astman->database_get("RINGGROUP", $grpnum . "/fixedcid");
			$results['fixedcid']  = preg_replace("/[^0-9\+]/", "", trim((string) $fixedcid));
		}
		else {
			throw new \RuntimeException("Cannot connect to Asterisk Manager");
		}
		return $results;
	}

	public function delete($grpnum) {
		$sql  = "DELETE FROM ringgroups WHERE grpnum = :grpnum";
		$stmt = $this->Database->prepare($sql);
		$stmt->execute([ ':grpnum' => $grpnum ]);
		if ($this->FreePBX->astman->connected()) {
			$this->FreePBX->astman->database_deltree("RINGGROUP/" . $grpnum);
		}
		else {
			die_freepbx("Cannot connect to Asterisk Manager with");
		}
		return $this;
	}

}