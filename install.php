<?php


#sccpdevmodel
if (!tableExists("sccpdevmodel") && version_compare(get_framework_version(),"14.0",">=")) 
{
	#FreePBX 14+ will create the database from the module.xml
	die_freepbx("Can not find sccpdevmodel table! This table should have been created by module.xml. Please check your installation\n" . get_framework_version());
}
else if (!tableExists("sccpdevmodel") && version_compare(get_framework_version(),"14.0","<"))
{
	#FreePBX 13 and lower we have to create the DB
	$sql = "CREATE TABLE IF NOT EXISTS `sccpdevmodel` (
    `model` varchar(20) NOT NULL DEFAULT '',
    `vendor` varchar(40) DEFAULT '',
    `dns` int(2) DEFAULT '1',
    `buttons` int(2) DEFAULT '0',
    `loadimage` varchar(40) DEFAULT '',
	`loadinformationid` varchar(30) DEFAULT '',
    PRIMARY KEY (`model`),
    KEY `model` (`model`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1";
	$sth = FreePBX::Database()->prepare($sql);
	$sth->execute();
}


if (tableEmpty("sccpdevmodel")) 
{
	$sql = "REPLACE INTO `sccpdevmodel` VALUES ('7925','CISCO',1,1,'',''),('7902','CISCO',1,1,'CP7902080002SCCP060817A','loadInformation30008'),('7905','CISCO',1,1,'CP7905080003SCCP070409A','loadInformation20000'),('7906','CISCO',1,1,'SCCP11.8-3-1S','loadInformation369'),('7910','CISCO',1,1,'P00405000700','loadInformation6'),('7911','CISCO',1,1,'SCCP11.8-3-1S','loadInformation307'),('7912','CISCO',1,1,'CP7912080003SCCP070409A','loadInformation30007'),('7914','CISCO',0,14,'S00105000300','loadInformation124'),('7920','CISCO',1,1,'cmterm_7920.4.0-03-02','loadInformation30002'),('7921','CISCO',1,1,'CP7921G-1.0.3','loadInformation365'),('7931','CISCO',1,1,'SCCP31.8-3-1S','loadInformation348'),('7936','CISCO',1,1,'cmterm_7936.3-3-13-0','loadInformation30019'),('7937','CISCO',1,1,'','loadInformation431'),('7940','CISCO',1,2,'P00308000500','loadInformation8'),('Digital Access+','CISCO',1,1,'D00303010033','loadInformation42'),('7941','CISCO',1,2,'P00308000500','loadInformation115'),('7941G-GE','CISCO',1,2,'P00308000500','loadInformation309'),('7942','CISCO',1,2,'P00308000500','loadInformation434'),('Digital Access','CISCO',1,1,'D001M022','loadInformation40'),('7945','CISCO',1,2,'P00308000500','loadInformation435'),('7960','CISCO',3,6,'P00308000500','loadInformation7'),('7961','CISCO',3,6,'P00308000500','loadInformation30018'),('7961G-GE','CISCO',3,6,'P00308000500','loadInformation308'),('7962','CISCO',3,6,'P00308000500','loadInformation404'),('7965','CISCO',3,6,'P00308000500','loadInformation436'),('7970','CISCO',3,8,'SCCP70.8-3-1S','loadInformation30006'),('7971','CISCO',3,8,'SCCP70.8-3-1S','loadInformation119'),('7975','CISCO',3,8,'SCCP70.8-3-1S','loadInformation437'),('7985','CISCO',3,8,'cmterm_7985.4-1-4-0','loadInformation302'),('ATA 186','CISCO',1,1,'ATA030203SCCP051201A','loadInformation12'),('IP Communicator','CISCO',1,1,'','loadInformation30016'),('12 SP','CISCO',1,1,'','loadInformation3'),('12 SP+','CISCO',1,1,'','loadInformation2'),('30 SP+','CISCO',1,1,'','loadInformation1'),('30 VIP','CISCO',1,1,'','loadInformation5'),('7914,7914','CISCO',0,28,'S00105000300','loadInformation124'),('7915','CISCO',0,14,'',''),('7916','CISCO',0,14,'',''),('7915,7915','CISCO',0,28,'',''),('7916,7916','CISCO',0,28,'',''),('CN622','MOTOROLA',1,1,'','loadInformation335'),('ICC','NOKIA',1,1,'',''),('E-Series','NOKIA',1,1,'',''),('3911','CISCO',1,1,'','loadInformation446'),('3951','CISCO',1,1,'','loadInformation412');";
	$sth = FreePBX::Database()->prepare($sql);
	try
	{
		$sth->execute();
	}
	catch (PDOException $exception)
	{
		die_freepbx("Can not REPLACE defaults into sccpdevmodel table\n" . $exception->getMessage() . "\n");
	}
}



#sccpline
if (!tableExists("sccpline")) 
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
if (!tableExists("sccpdevice")) 
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
if (!tableExists("buttonconfig")) 
{
    die_freepbx("Can not find buttonconfig table, you must install chan_sccp and configure realtime databases (sccpline, sccpdevice and buttonconfig) before installing sccp-manager!\n");
}


function tableExists($tableName) 
{
    $mrSql = "SHOW TABLES LIKE :table_name";
    $mrStmt = FreePBX::Database()->prepare($mrSql);
    //protect from injection attacks
    $mrStmt->bindParam(":table_name", $tableName, PDO::PARAM_STR);

    $sqlResult = $mrStmt->execute();
    if ($sqlResult) {
        $row = $mrStmt->fetch(PDO::FETCH_NUM);
        if ($row[0]) {
            //table was found
            return true;
        } else {
            //table was not found
            return false;
        }
    } else {
        //some PDO error occurred
        echo("Could not check if table exists, Error: ".var_export($pdo->errorInfo(), true));
        return false;
    }
}

function tableEmpty($tableName) 
{
    $mrSql = "SELECT * FROM " . $tableName;
    $mrStmt = FreePBX::Database()->prepare($mrSql);

    $sqlResult = $mrStmt->execute();
    if ($sqlResult) {
        $row = $mrStmt->fetch(PDO::FETCH_NUM);
        if ($row[0]) {
            //a row was found
            return false;
        } else {
            //a row was not found
            return true;
        }
    } else {
        //some PDO error occurred
        echo("Could not check if table was empty, Error: ".var_export($pdo->errorInfo(), true));
        return false;
    }
}