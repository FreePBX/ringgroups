CREATE TABLE IF NOT EXISTS `ringgroups` 
( 
	`grpnum` VARCHAR( 20 ) NOT NULL , 
	`strategy` VARCHAR( 50 ) NOT NULL , 
	`grptime` SMALLINT NOT NULL , 
	`grppre` VARCHAR( 100 ) NULL , 
	`grplist` VARCHAR( 255 ) NOT NULL , 
	`annmsg` VARCHAR( 255 ) NULL , 
	`postdest` VARCHAR( 255 ) NULL , 
	`description` VARCHAR( 35 ) NOT NULL , 
	`alertinfo` VARCHAR ( 255 ) NULL , 
	`remotealert` VARCHAR ( 80 ), 
	`needsconf` VARCHAR ( 10 ), 
	`toolate` VARCHAR ( 80 ), 
	`cwignore` VARCHAR ( 10 ), 
	`cfignore` VARCHAR ( 10 ), 
	PRIMARY KEY  (`grpnum`) 
); 
