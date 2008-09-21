<?php

if (! function_exists("out")) {
	function out($text) {
		echo $text."<br />";
	}
}

if (! function_exists("outn")) {
	function outn($text) {
		echo $text;
	}
}

global $db;
global $amp_conf;

$sql = "
CREATE TABLE IF NOT EXISTS `ringgroups` 
( 
	`grpnum` VARCHAR( 20 ) NOT NULL , 
	`strategy` VARCHAR( 50 ) NOT NULL , 
	`grptime` SMALLINT NOT NULL , 
	`grppre` VARCHAR( 100 ) NULL , 
	`grplist` VARCHAR( 255 ) NOT NULL , 
	`annmsg_id` INTEGER,
	`postdest` VARCHAR( 255 ) NULL , 
	`description` VARCHAR( 35 ) NOT NULL , 
	`alertinfo` VARCHAR ( 255 ) NULL , 
	`remotealert_id` INTEGER,
	`needsconf` VARCHAR ( 10 ), 
	`toolate_id` INTEGER,
  `ringing` VARCHAR( 80 ) NULL,
	`cwignore` VARCHAR ( 10 ), 
	`cfignore` VARCHAR ( 10 ), 
	PRIMARY KEY  (`grpnum`) 
) 
";
$check = $db->query($sql);
if(DB::IsError($check)) {
	die_freepbx("Can not create annoucment table");
}

// The following updates were all pre-2.5 when sqlite3 was not supported)
//
if($amp_conf["AMPDBENGINE"] != "sqlite3")  {
	// Version 1.1 upgrade
	$sql = "SELECT description FROM ringgroups";
	$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	if(DB::IsError($check)) {
		// add new field
    	$sql = "ALTER TABLE ringgroups ADD description VARCHAR( 35 ) NULL ;";
    	$result = $db->query($sql);
    	if(DB::IsError($result)) {
				die_freepbx($result->getDebugInfo());
    	}

    	// update existing groups
    	$sql = "UPDATE ringgroups SET description = CONCAT('Ring Group ', grpnum) WHERE description IS NULL ;";
    	$result = $db->query($sql);
    	if(DB::IsError($result)) {
				die_freepbx($result->getDebugInfo());
			}

		// make new field required
		$sql = "ALTER TABLE `ringgroups` CHANGE `description` `description` VARCHAR( 35 ) NOT NULL ;";
    	$result = $db->query($sql);
    	if(DB::IsError($result)) {
				die_freepbx($result->getDebugInfo());
    	}
	}
	// Version 1.2 upgrade
	$sql = "SELECT alertinfo FROM ringgroups";
	$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	if(DB::IsError($check)) {
		// add new field
    $sql = "ALTER TABLE ringgroups ADD alertinfo VARCHAR( 255 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) {
			die_freepbx($result->getDebugInfo());
		}
	}
	// increase size for older installs
	$db->query("ALTER TABLE ringgroups CHANGE alertinfo alertinfo VARCHAR( 255 ) NULL");

	// If there is no needsconf then this is a really old upgrade. We create the 2 old fields
	// here  and then the migration code below will change them as needed but will work properly
	// since it now has the fields it is expecting
	//
	$sql = "SELECT needsconf FROM ringgroups";
	$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	if(DB::IsError($check)) {
		// add new field
    $sql = "ALTER TABLE ringgroups ADD remotealert VARCHAR( 80 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die_freepbx($result->getDebugInfo()); }

    $sql = "ALTER TABLE ringgroups ADD needsconf VARCHAR( 10 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die_freepbx($result->getDebugInfo()); }

    $sql = "ALTER TABLE ringgroups ADD toolate VARCHAR( 80 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die_freepbx($result->getDebugInfo()); }
	}
	// Version 2.1 upgrade. Add support for ${DIALOPTS} override, playing MOH
	$sql = "SELECT ringing FROM ringgroups";
	$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	if(DB::IsError($check)) {
		// add new field
    $sql = "ALTER TABLE ringgroups ADD ringing VARCHAR( 80 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die_freepbx($result->getDebugInfo()); }
	}

	$results = array();
	$sql = "SELECT grpnum, postdest FROM ringgroups";
	$results = $db->getAll($sql, DB_FETCHMODE_ASSOC);
	if (!DB::IsError($results)) { // error - table must not be there
		foreach ($results as $result) {
			$old_dest  = $result['postdest'];
			$grpnum    = $result['grpnum'];

			$new_dest = merge_ext_followme(trim($old_dest));
			if ($new_dest != $old_dest) {
				$sql = "UPDATE ringgroups SET postdest = '$new_dest' WHERE grpnum = $grpnum  AND postdest = '$old_dest'";
				$results = $db->query($sql);
				if(DB::IsError($results)) {
					die_freepbx($results->getMessage());
				}
			}
		}
	}

	// Version 2.2.16 change (#1961)
	//
	$results = $db->query("ALTER TABLE `ringgroups` CHANGE `grpnum` `grpnum` VARCHAR( 20 ) NOT NULL");
	if(DB::IsError($results)) {
		echo $results->getMessage();
		return false;
	}

	// 2.5 upgrades
	$sql = "SELECT cwignore FROM ringgroups";
	$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	if(DB::IsError($check)) {
		// add new field
    $sql = "ALTER TABLE ringgroups ADD cwignore VARCHAR( 10 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die_freepbx($result->getDebugInfo()); }
	}

	$sql = "SELECT cfignore FROM ringgroups";
	$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	if(DB::IsError($check)) {
		// add new field
    $sql = "ALTER TABLE ringgroups ADD cfignore VARCHAR( 10 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die_freepbx($result->getDebugInfo()); }
	}

	// Version 2.5 migrate to recording ids
	//
	outn(_("Checking if recordings need migration.."));
	$sql = "SELECT annmsg_id FROM ringgroups";
	$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
	if(DB::IsError($check)) {
		//  Add recording_id field
		//
		out(_("migrating"));
		outn(_("adding annmsg_id field.."));
  	$sql = "ALTER TABLE ringgroups ADD annmsg_id INTEGER";
  	$result = $db->query($sql);
  	if(DB::IsError($result)) {
			out(_("fatal error"));
			die_freepbx($result->getDebugInfo()); 
		} else {
			out(_("ok"));
		}
		outn(_("adding remotealert_id field.."));
  	$sql = "ALTER TABLE ringgroups ADD remotealert_id INTEGER";
  	$result = $db->query($sql);
  	if(DB::IsError($result)) {
			out(_("fatal error"));
			die_freepbx($result->getDebugInfo()); 
		} else {
			out(_("ok"));
		}
		outn(_("adding toolate_id field.."));
  	$sql = "ALTER TABLE ringgroups ADD toolate_id INTEGER";
  	$result = $db->query($sql);
  	if(DB::IsError($result)) {
			out(_("fatal error"));
			die_freepbx($result->getDebugInfo()); 
		} else {
			out(_("ok"));
		}

		// Get all the valudes and replace them with recording_id
		//
		outn(_("migrate annmsg to ids.."));
  	$sql = "SELECT `grpnum`, `annmsg` FROM `ringgroups`";
		$results = $db->getAll($sql, DB_FETCHMODE_ASSOC);
		if(DB::IsError($results)) {
			out(_("fatal error"));
			die_freepbx($results->getDebugInfo());	
		}
		$migrate_arr = array();
		$count = 0;
		foreach ($results as $row) {
			if (trim($row['annmsg']) != '') {
				$rec_id = recordings_get_or_create_id($row['annmsg'], 'ringgroups');
				$migrate_arr[] = array($rec_id, $row['grpnum']);
				$count++;
			}
		}
		if ($count) {
			$compiled = $db->prepare('UPDATE `ringgroups` SET `annmsg_id` = ? WHERE `grpnum` = ?');
			$result = $db->executeMultiple($compiled,$migrate_arr);
			if(DB::IsError($result)) {
				out(_("fatal error"));
				die_freepbx($result->getDebugInfo());	
			}
		}
		out(sprintf(_("migrated %s entries"),$count));

		outn(_("migrate remotealert to  ids.."));
  	$sql = "SELECT `grpnum`, `remotealert` FROM `ringgroups`";
		$results = $db->getAll($sql, DB_FETCHMODE_ASSOC);
		if(DB::IsError($results)) {
			out(_("fatal error"));
			die_freepbx($results->getDebugInfo());	
		}
		$migrate_arr = array();
		$count = 0;
		foreach ($results as $row) {
			if (trim($row['remotealert']) != '') {
				$rec_id = recordings_get_or_create_id($row['remotealert'], 'ringgroups');
				$migrate_arr[] = array($rec_id, $row['grpnum']);
				$count++;
			}
		}
		if ($count) {
			$compiled = $db->prepare('UPDATE `ringgroups` SET `remotealert_id` = ? WHERE `grpnum` = ?');
			$result = $db->executeMultiple($compiled,$migrate_arr);
			if(DB::IsError($result)) {
				out(_("fatal error"));
				die_freepbx($result->getDebugInfo());	
			}
		}
		out(sprintf(_("migrated %s entries"),$count));

		outn(_("migrate toolate to ids.."));
  	$sql = "SELECT `grpnum`, `toolate` FROM `ringgroups`";
		$results = $db->getAll($sql, DB_FETCHMODE_ASSOC);
		if(DB::IsError($results)) {
			out(_("fatal error"));
			die_freepbx($results->getDebugInfo());	
		}
		$migrate_arr = array();
		$count = 0;
		foreach ($results as $row) {
			if (trim($row['toolate']) != '') {
				$rec_id = recordings_get_or_create_id($row['toolate'], 'ringgroups');
				$migrate_arr[] = array($rec_id, $row['grpnum']);
				$count++;
			}
		}
		if ($count) {
			$compiled = $db->prepare('UPDATE `ringgroups` SET `toolate_id` = ? WHERE `grpnum` = ?');
			$result = $db->executeMultiple($compiled,$migrate_arr);
			if(DB::IsError($result)) {
				out(_("fatal error"));
				die_freepbx($result->getDebugInfo());	
			}
		}
		out(sprintf(_("migrated %s entries"),$count));

		// Now remove the old recording field replaced by new id field
		//
		outn(_("dropping annmsg field.."));
  	$sql = "ALTER TABLE `ringgroups` DROP `annmsg`";
  	$result = $db->query($sql);
  	if(DB::IsError($result)) { 
			out(_("no annmsg field???"));
		} else {
			out(_("ok"));
		}
		outn(_("dropping remotealert field.."));
  	$sql = "ALTER TABLE `ringgroups` DROP `remotealert`";
  	$result = $db->query($sql);
  	if(DB::IsError($result)) { 
			out(_("no remotealert field???"));
		} else {
			out(_("ok"));
		}
		outn(_("dropping toolate field.."));
  	$sql = "ALTER TABLE `ringgroups` DROP `toolate`";
  	$result = $db->query($sql);
  	if(DB::IsError($result)) { 
			out(_("no toolate field???"));
		} else {
			out(_("ok"));
		}

	} else {
		out(_("already migrated"));
	}
}
?>
