<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
$dbh = \FreePBX::Database();
global $db;
global $amp_conf;
$table = \FreePBX::Database()->migrate("ringgroups");
$cols = array (
  'grpnum' =>array (
    'type' => 'string',
    'length' => '20',
    'primaryKey' => true,
  ),
  'strategy' =>array (
    'type' => 'string',
    'length' => '50',
  ),
  'grptime' =>array (
    'type' => 'smallint',
  ),
  'grppre' =>array (
    'type' => 'string',
    'length' => '100',
    'notnull' => false,
  ),
  'grplist' =>array (
    'type' => 'string',
    'length' => '255',
  ),
  'annmsg_id' =>array (
    'type' => 'integer',
    'notnull' => false,
  ),
  'postdest' =>array (
    'type' => 'string',
    'length' => '255',
    'notnull' => false,
  ),
  'description' =>array (
    'type' => 'string',
    'length' => '35',
  ),
  'alertinfo' =>array (
    'type' => 'string',
    'length' => '255',
    'notnull' => false,
  ),
  'remotealert_id' =>array (
    'type' => 'integer',
    'notnull' => false,
  ),
  'needsconf' =>array (
    'type' => 'string',
    'length' => '10',
    'notnull' => false,
  ),
  'toolate_id' =>array (
    'type' => 'integer',
    'notnull' => false,
  ),
  'ringing' =>array (
    'type' => 'string',
    'length' => '80',
    'notnull' => false,
  ),
  'cwignore' =>array (
    'type' => 'string',
    'length' => '10',
    'notnull' => false,
  ),
  'cfignore' =>array (
    'type' => 'string',
    'length' => '10',
    'notnull' => false,
  ),
  'cpickup' =>array (
    'type' => 'string',
    'length' => '10',
    'notnull' => false,
  ),
  'recording' =>array (
    'type' => 'string',
    'length' => '10',
    'notnull' => false,
    'default' => 'dontcare',
  ),
  'progress' =>array (
    'type' => 'string',
    'length' => '10',
    'notnull' => false,
  ),
  'elsewhere' =>array (
    'type' => 'string',
    'length' => '10',
    'notnull' => false,
  ),
);

$table->modify($cols);
unset($table);



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
}

$freepbx_conf =& freepbx_conf::create();

// EXTENSION_LIST_RINGGROUPS
//
$set['value'] = false;
$set['defaultval'] =& $set['value'];
$set['readonly'] = 0;
$set['hidden'] = 0;
$set['level'] = 0;
$set['module'] = 'ringgroups';
$set['category'] = 'Ring Group Module';
$set['emptyok'] = 0;
$set['sortorder'] = 50;
$set['name'] = 'Display Extension Ring Group Members';
$set['description'] = 'When set to true extensions that belong to one or more Ring Groups will have a Ring Group section and link back to each group they are a member of.';
$set['type'] = CONF_TYPE_BOOL;
$freepbx_conf->define_conf_setting('EXTENSION_LIST_RINGGROUPS',$set, true);


// Fix recording status. If it's 'yes' or 'no, it should be 'force' or 'never'.
$sql = 'UPDATE `ringgroups` SET `recording`="never" WHERE `recording`="no"';
$db->query($sql);
$sql = 'UPDATE `ringgroups` SET `recording`="force" WHERE `recording`="yes"';
$db->query($sql);
