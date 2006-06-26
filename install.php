<?php

global $db;

// Version 1.1 upgrade
$sql = "SELECT description FROM ringgroups";
$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
if(DB::IsError($check)) {
	// add new field
    $sql = "ALTER TABLE ringgroups ADD description VARCHAR( 35 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) {
            die($result->getDebugInfo());
    }

    // update existing groups
    $sql = "UPDATE ringgroups SET description = CONCAT('Ring Group ', grpnum) WHERE description IS NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) {
            die($result->getDebugInfo());
    }

	// make new field required
	$sql = "ALTER TABLE `ringgroups` CHANGE `description` `description` VARCHAR( 35 ) NOT NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) {
            die($result->getDebugInfo());
    }
}
// Version 1.2 upgrade
$sql = "SELECT alertinfo FROM ringgroups";
$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
if(DB::IsError($check)) {
	// add new field
    $sql = "ALTER TABLE ringgroups ADD alertinfo VARCHAR( 35 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) {
            die($result->getDebugInfo());
    }
}

// Version 2.0 upgrade. Yeah. 2.0 baby! 
$sql = "SELECT remotealert FROM ringgroups";
$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
if(DB::IsError($check)) {
	// add new field
    $sql = "ALTER TABLE ringgroups ADD remotealert VARCHAR( 80 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die($result->getDebugInfo()); }

    $sql = "ALTER TABLE ringgroups ADD needsconf VARCHAR( 10 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die($result->getDebugInfo()); }

    $sql = "ALTER TABLE ringgroups ADD toolate VARCHAR( 80 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die($result->getDebugInfo()); }
}
// Version 2.1 upgrade. Add support for ${DIALOPTS} override, playing MOH
$sql = "SELECT ringing FROM ringgroups";
$check = $db->getRow($sql, DB_FETCHMODE_ASSOC);
if(DB::IsError($check)) {
	// add new field
    $sql = "ALTER TABLE ringgroups ADD ringing VARCHAR( 80 ) NULL ;";
    $result = $db->query($sql);
    if(DB::IsError($result)) { die($result->getDebugInfo()); }
}


?>
