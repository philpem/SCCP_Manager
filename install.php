<?php


#sccpdevmodel
$sql = 'SHOW COLUMNS FROM sccpdevmodel WHERE FIELD = "id"';
$sth = FreePBX::Database()->prepare($sql);
$sth->execute();
$array = $sth->fetchAll(PDO::FETCH_ASSOC);
if (empty($array)) 
{
		die_freepbx("Can not find sccpdevmodel table! This table should have been created by module.xml. Please check your installation\n");
}
else
{
	$sql = 'SELECT * FROM sccpdevmodel';
	$sth = FreePBX::Database()->prepare($sql);
	$sth->execute();
	$array = $sth->fetchAll(PDO::FETCH_ASSOC);
	if (empty($array)) 
	{
		$sql = "REPLACE INTO `sccpdevmodel` VALUES ('7925','CISCO',1,1,'',''),('7902','CISCO',1,1,'CP7902080002SCCP060817A','loadInformation30008'),('7905','CISCO',1,1,'CP7905080003SCCP070409A','loadInformation20000'),('7906','CISCO',1,1,'SCCP11.8-3-1S','loadInformation369'),('7910','CISCO',1,1,'P00405000700','loadInformation6'),('7911','CISCO',1,1,'SCCP11.8-3-1S','loadInformation307'),('7912','CISCO',1,1,'CP7912080003SCCP070409A','loadInformation30007'),('7914','CISCO',0,14,'S00105000300','loadInformation124'),('7920','CISCO',1,1,'cmterm_7920.4.0-03-02','loadInformation30002'),('7921','CISCO',1,1,'CP7921G-1.0.3','loadInformation365'),('7931','CISCO',1,1,'SCCP31.8-3-1S','loadInformation348'),('7936','CISCO',1,1,'cmterm_7936.3-3-13-0','loadInformation30019'),('7937','CISCO',1,1,'','loadInformation431'),('7940','CISCO',1,2,'P00308000500','loadInformation8'),('Digital Access+','CISCO',1,1,'D00303010033','loadInformation42'),('7941','CISCO',1,2,'P00308000500','loadInformation115'),('7941G-GE','CISCO',1,2,'P00308000500','loadInformation309'),('7942','CISCO',1,2,'P00308000500','loadInformation434'),('Digital Access','CISCO',1,1,'D001M022','loadInformation40'),('7945','CISCO',1,2,'P00308000500','loadInformation435'),('7960','CISCO',3,6,'P00308000500','loadInformation7'),('7961','CISCO',3,6,'P00308000500','loadInformation30018'),('7961G-GE','CISCO',3,6,'P00308000500','loadInformation308'),('7962','CISCO',3,6,'P00308000500','loadInformation404'),('7965','CISCO',3,6,'P00308000500','loadInformation436'),('7970','CISCO',3,8,'SCCP70.8-3-1S','loadInformation30006'),('7971','CISCO',3,8,'SCCP70.8-3-1S','loadInformation119'),('7975','CISCO',3,8,'SCCP70.8-3-1S','loadInformation437'),('7985','CISCO',3,8,'cmterm_7985.4-1-4-0','loadInformation302'),('ATA 186','CISCO',1,1,'ATA030203SCCP051201A','loadInformation12'),('IP Communicator','CISCO',1,1,'','loadInformation30016'),('12 SP','CISCO',1,1,'','loadInformation3'),('12 SP+','CISCO',1,1,'','loadInformation2'),('30 SP+','CISCO',1,1,'','loadInformation1'),('30 VIP','CISCO',1,1,'','loadInformation5'),('7914,7914','CISCO',0,28,'S00105000300','loadInformation124'),('7915','CISCO',0,14,'',''),('7916','CISCO',0,14,'',''),('7915,7915','CISCO',0,28,'',''),('7916,7916','CISCO',0,28,'',''),('CN622','MOTOROLA',1,1,'','loadInformation335'),('ICC','NOKIA',1,1,'',''),('E-Series','NOKIA',1,1,'',''),('3911','CISCO',1,1,'','loadInformation446'),('3951','CISCO',1,1,'','loadInformation412');";
		$check = $db->query($sql);
		if(DB::IsError($check)) 
		{
			die_freepbx("Can not REPLACE defaults into sccpdevmodel table\n");
		}
	}
}


#sccpline
$sql = 'SHOW COLUMNS FROM sccpline WHERE FIELD = "id"';
$sth = FreePBX::Database()->prepare($sql);
$sth->execute();
$array = $sth->fetchAll(PDO::FETCH_ASSOC);
if (empty($array)) 
{
	die_freepbx("Can not find sccpline table, you must install chan_sccp and configure realtime databases (sccpline and sccpdevice) before installing sccp-manager!\n");
}
else
{
    $sql = "ALTER TABLE sccpline
	 ALTER COLUMN incominglimit SET DEFAULT '2',
	 ALTER COLUMN transfer SET DEFAULT 'on',
	 ALTER COLUMN vmnum SET DEFAULT '*97',
	 ALTER COLUMN musicclass SET DEFAULT 'default',
	 ALTER COLUMN echocancel SET DEFAULT 'on',
	 ALTER COLUMN silencesuppression SET DEFAULT 'off',
	 ALTER COLUMN dnd SET DEFAULT 'off'
    " ;
    
    $check = $db->query($sql);
    if(DB::IsError($check)) 
	{
	die_freepbx("Can not modify sccpline table\n");
    }
}



#sccpdevice
$sql = 'SHOW COLUMNS FROM sccpdevice WHERE FIELD = "id"';
$sth = FreePBX::Database()->prepare($sql);
$sth->execute();
$array = $sth->fetchAll(PDO::FETCH_ASSOC);
if (empty($array)) 
{
    
    die_freepbx("Can not find sccpdevice table, you must install chan_sccp and configure realtime databases (sccpline, sccpdevice, buttonconfig) before installing sccp-manager!\n");
}
else
{
    
    $sql = "ALTER TABLE sccpdevice
    
	ALTER COLUMN transfer SET DEFAULT 'on',
	ALTER COLUMN cfwdall SET DEFAULT 'on',
	ALTER COLUMN cfwdbusy SET DEFAULT 'on',
	ALTER COLUMN dndFeature SET DEFAULT 'on',
	ALTER COLUMN directrtp SET DEFAULT 'off',
	ALTER COLUMN earlyrtp SET DEFAULT 'progress',
	ALTER COLUMN mwilamp SET DEFAULT 'on',
	ALTER COLUMN mwioncall SET DEFAULT 'on',
	ALTER COLUMN pickupexten SET DEFAULT 'on',
	ALTER COLUMN pickupmodeanswer SET DEFAULT 'on',
	ALTER COLUMN private SET DEFAULT 'on',
	ALTER COLUMN privacy SET DEFAULT 'off',
	ALTER COLUMN nat SET DEFAULT 'off',
	ALTER COLUMN softkeyset SET DEFAULT 'softkeyset'
    " ;

    $check = $db->query($sql);
    if(DB::IsError($check)) 
	{
		die_freepbx("Can not modify sccpdevice table\n");
    }
}

#buttonconfig
$sql = 'SHOW COLUMNS FROM buttonconfig WHERE FIELD = "device"';
$sth = FreePBX::Database()->prepare($sql);
$sth->execute();
$array = $sth->fetchAll(PDO::FETCH_ASSOC);
if (empty($array)) 
{
    die_freepbx("Can not find buttonconfig table, you must install chan_sccp and configure realtime databases (sccpline, sccpdevice and buttonconfig) before installing sccp-manager!\n");
}

