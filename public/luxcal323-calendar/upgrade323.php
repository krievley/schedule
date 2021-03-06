<?php
/*
!!!!!!! AFTER UPLOADING A NEW LUXCAL VERSION TO YOUR SERVER, THIS !!!!!!!
!!!!!!! SCRIPT WILL RUN AUTOMATICALLY WHEN STARTING THE CALENDAR. !!!!!!!
!!!!!!! YOU MAY LAUNCH THIS SCRIPT VIA YOUR BROWSER AT ANY TIME.  !!!!!!!

� Copyright 2009-2014 LuxSoft - www.LuxSoft.eu
*/

//Functions

//Cipher a string (needed for LuxCal 2.6.0 - 2.7.2)
function ciph($s,$n=0) {
	$splits = str_split($s);
	foreach ($splits as &$ch) { //lc:F uc:C
		$c = ord($ch);
		if ($c == 58-($n*26)) { $ch = chr(32+($n*26)); }
		$ch = ($c >= 97 and $c <= 122) ? chr(($c-82-($n*4))%26+97) : (($c >= 65 and $c <= 90) ? chr(($c-53+($n*2))%26+65) : $ch);
	}
	return implode($splits);
}

//Process calendar settings for calendar &calID
function processSettings($calID) {
	//get settings from calendar
	$dbSet = getSettings();
	if (!empty($dbSet)) { echo "<li>Calendar settings retrieved from database.</li>\n"; }

	//convert 2.7.1 date settings to new settings
	$ds = isset($dbSet['dateSep']) ? $dbSet['dateSep'] : '.'; //dateSep: LuxCal 2.7.1
	if (isset($dbSet['dateFormat'])) {
		switch ($dbSet['dateFormat']) { //dateSep: LuxCal 2.7.1 format
			case '1': $dbSet['dateFormat'] = 'd'.$ds.'m'.$ds.'y'; break;
			case '2': $dbSet['dateFormat'] = 'm'.$ds.'d'.$ds.'y'; break;
			case '3': $dbSet['dateFormat'] = 'y'.$ds.'m'.$ds.'d';
		}
	}
	if (empty($dbSet['MdFormat'])) { $dbSet['MdFormat'] = empty($dbSet['dateUSorEU']) ? 'M d' : 'd M'; } //dateUSorEU: LuxCal 2.7.1
	if (empty($dbSet['MdyFormat'])) { $dbSet['MdyFormat'] = empty($dbSet['dateUSorEU']) ? 'M d, y' : 'd M y'; }
	if (empty($dbSet['MyFormat'])) { $dbSet['MyFormat'] = empty($dbSet['dateUSorEU']) ? 'M y' : 'M y'; }
	if (empty($dbSet['DMdFormat'])) { $dbSet['DMdFormat'] = empty($dbSet['dateUSorEU']) ? 'WD, M d' : 'WD d M'; }
	if (empty($dbSet['DMdyFormat'])) { $dbSet['DMdyFormat'] = empty($dbSet['dateUSorEU']) ? 'WD, M d, y' : 'WD d M y'; }
	if (empty($dbSet['timeFormat'])) { $dbSet['timeFormat'] = empty($dbSet['time24']) ? 'h:ma' : 'h.m'; } //time24: LuxCal 2.7.1

	//check and complete settings
	checkSettings($dbSet); //if $dbSet['x'] empty, set to default value
	echo "<li>Calendar settings verified/completed.</li>\n";

	//save calendar settings to calendar
	$result = saveSettings($calID,$dbSet,true);
	if ($result === false) { exit('Error: Unable to save settings in database. Check database credentials.'); }
	echo "<li>Calendar settings saved to database.</li>\n";
	return $result;
}
//End of Functions

//sanity check
if (version_compare(PHP_VERSION,'5.1.0') < 0) { //check PHP version
	exit('<br><br><b>Wrong PHP version</b><br><br>You need version 5.1.0 or higher<br>Your current version is: '.PHP_VERSION);
}

//start PHP session (needed to be able to unset session variables later)
session_start();
setcookie('LCALcid', '', time()-3600); //delete possible calID cookie of previous installation
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LuxCal Event Calendar - Upgrade</title>
<meta name="description" content="LuxCal web calendar - a LuxSoft product">
<meta name="keywords" content="LuxSoft, LuxCal, LuxCal web calendar">
<meta name="author" content="Roel Buining">
<meta name="robots" content="nofollow">
<link rel="icon" href="lcal.ico">
<style type="text/css">
header, footer, aside {display:block;}
* { padding:0; margin:0; }
body {font:11px arial, sans-serif; background:#E0E0E0; color:#2B3856; cursor:default;}
a {text-decoration:none; cursor:pointer;}
header {padding:0 1%;}
h3 {margin:8px 0; font-size:14pt;}
h4 {margin:6px 0; font-size:12pt;}
h5 {margin:6px 0; font-size:11pt;}
ul {margin:0 20px;}
li {margin:5px 0;}
input {font:11px arial, sans-serif;}
input[type="button"] {margin-top:15px; cursor:pointer;}
.flag {color:#FF3300;}
.navBar {
	width:98%;
	padding:0 1%;
	margin-bottom: 40px;
	background:#AAAAFF;
	text-align:right;
	border-top:1px solid #808080;
	border-bottom:1px solid #808080;
	line-height:20px;
	vertical-align:middle;
}
.endBar {
	position:absolute; left:0; bottom:10px;
	width:98%;
	padding:0 1%;
	background:#AAAAFF;
	text-align:right;
	border-top:1px solid #808080;
	border-bottom:1px solid #808080;
	font-size:0.8em;
}
div.content {
	position:absolute; left:0; top:160px; right:0px; bottom:100px;
	padding:0 200px;
	overflow:auto;
}
.centerBox {display:table; margin:40px auto; border:1px solid #808080; background:#FFFFFF; padding:15px; }
.bLine {position:absolute; left:0; bottom:50px; width:98%; text-align:center;}
.mark {color:#AA0000;}
.error {margin:10px 0; background:#F0A070;}
.center {text-align:center;}
.floatR {float:right;}
.footLB {font:italic bold 1.1em arial,sans-serif; color:#0033FF;}
.footLR {font:italic bold 1.1em arial,sans-serif; color:#AA0066;}
</style>
</head>

<body>
<header>
<h4>LuxCal Event Calendar</h4>
</header>
<div class="navBar">Your PHP version: <?php echo PHP_VERSION; ?></div>
<h3 class="center">Calendar Upgrade</h3>
<div class="content">
<h5>Start of Upgrade</h5>
<ul>
<?php
//get php tools
require_once './common/toolbox.php';
require './common/toolboxx.php'; //admin tools

//initialize
$dbConnected = empty($calID) ? false : $true; //If !false: connected to MySQL db
$dbHost = $dbName = $dbUnam = $dbPwrd = $dbPfix = '';

//get current LuxCal version
$lcVersion = substr(basename(__FILE__),-7,-4);
$lcVersion = $lcVersion[0].'.'.$lcVersion[1].'.'.$lcVersion[2];
define("LCV",$lcVersion);

//get database credentials
if (file_exists('./lcconfig.php')) { //try lcconfig.php (LuxCal 2.7.3+)
	include './lcconfig.php';
	echo "<li>Configuration file 'lcconfig.php' found. Database credentials loaded.</li>\n";
}
if (empty($dbName) and file_exists('./lcaldbc.dat')) { //try lcaldbc.dat (LuxCal 2.6.0 - 2.7.2)
	if (list(,,$dbc) = file('./lcaldbc.dat',FILE_IGNORE_NEW_LINES)) {
		list($dbHost,$dbName,$dbUnam,$dbPwrd,$dbPfix) = unserialize(ciph($dbc,1));
		echo "<li>Configuration file 'lcaldbc.dat' found. Database credentials loaded.</li>\n";
	}
}
if (empty($dbName)) { //no db credentials found
	exit('Could find no database credentials in calendar root folder');
}

//if not connected, try to connect to db server and select db
if ($dbConnected === false) { //not connected
	$dbLink = mysql_connect($dbHost, $dbUnam, $dbPwrd);
	if (!$dbLink) { exit('Could not connect to the MySQL server: '.mysql_error()); }
	$dbSeld = mysql_select_db($dbName,$dbLink);
	if (!$dbSeld) { exit('Could not select the MySQL database:'.mysql_error()); }
}
echo "<li>Connected to database server '{$dbHost}' and database '{$dbName}' selected.</li>\n";

/*============================= start upgrading ==============================*/

//check/update table prefixes
$rSet = dbQuery("SHOW TABLES LIKE '%settings'");
while ($row = mysql_fetch_row($rSet)) {
	$matches = array();
	if (preg_match('~^([a-z\d]{0,20})settings$~',$row[0],$matches)) { //match; no separator (_)
		$fromPf = empty($matches[1]) ? '' : $matches[1];
		$toPf = empty($matches[1]) ? 'mycal' : $matches[1]; //no prefix: 'mycal'
		$q = "RENAME TABLE
		{$fromPf}events     TO {$toPf}_events,
		{$fromPf}categories TO {$toPf}_categories,
		{$fromPf}users      TO {$toPf}_users,
		{$fromPf}settings   TO {$toPf}_settings
		";
		$result = dbQuery($q);
		if ($result) { echo "<li>Tables '{$fromPf}xxxxxx' renamed to '{$toPf}_xxxxxx'</li>\n"; }
	}
}
$calID = $dbPfix = ($dbPfix ? rtrim($dbPfix,'_') : 'mycal'); //remove posible separator "_"
echo "<li>Table prefix for default calendar: '{$dbPfix}', followed by the automatically added separator '_'.</li>\n";

//get settings of default calendar and set time zone
$dbSet = getSettings();
date_default_timezone_set($dbSet['timeZone']);
echo "<li>Default calendar settings retrieved and timezone set to: {$dbSet['timeZone']}.</li>\n";

/* ===== As of LuxCal 2.6 ===== */
//Add column r_month to events table
$result = dbQuery("SELECT r_month FROM ".$calID."_events",0);
if (!$result) { //column 'r_month' not present
	$altered = dbQuery("ALTER TABLE ".$calID."_events
		ADD	`r_month` TINYINT(1) unsigned NOT NULL DEFAULT '0' AFTER `r_period`
	");
}
//Add table [db]settings to database
$result = dbQuery("SHOW TABLES LIKE '".$calID."_settings'");
if (mysql_num_rows($result) == 0) { //table [db]settings not existing
	createDbTable("settings", $calID);
}

/* ===== As of LuxCal 2.7.3 ===== */

//renumber category sequence (now starting at 1)
$rSet = dbQuery("SELECT category_id AS cid FROM ".$calID."_categories WHERE status >= 0 ORDER BY sequence");
if ($rSet !== false) {
	$count = 1;
	while ($row = mysql_fetch_assoc($rSet)) {
		dbQuery("UPDATE ".$calID."_categories SET `sequence`=".$count++." WHERE `category_id` = ".$row['cid']);
	}
}

/* ===== As of LuxCal 3.1.0 ===== */

//Add table x_sessdata to database
$result = dbQuery("SHOW TABLES LIKE 'x_sessdata'");
if (mysql_num_rows($result) == 0) { //table sessdata not existing
	createDbTable("sessdata");
}

//get calendar IDs
$rSet = dbQuery("SHOW TABLES LIKE '%settings'"); //get table prefixes
$calIDs = array();
while ($row = mysql_fetch_row($rSet)) {
	if (substr($row[0],-9,1) == '_') { //has prefix_
		$calIDs[] = substr($row[0],0,-9);
	}
}

foreach ($calIDs as $calID) { //do for all calendars in this db
	//process calendar settings for this calendar
	echo "<li>Processing calendar '{$calID}'\n";
	echo "<ul>\n";
	processSettings($calID);
	//Checking database tables of calendar
	//add primary key to settings table
	$result = dbQuery("SHOW KEYS FROM ".$calID."_settings WHERE Key_name = 'PRIMARY'");
	if (mysql_num_rows($result) == 0) { //no primary key defined
		$altered = dbQuery("ALTER TABLE ".$calID."_settings
			ADD PRIMARY KEY (name)
			");
	}
	//Add column approve to categories table
	$result = dbQuery("SELECT `approve` FROM ".$calID."_categories",0);
	if (!$result) { //column 'approve' not present
		$altered = dbQuery("ALTER TABLE ".$calID."_categories
			ADD	`approve` TINYINT(1) unsigned NOT NULL DEFAULT '0' AFTER `rpeat`
		");
	}
	//Add column approved to events table
	$result = dbQuery("SELECT approved FROM ".$calID."_events",0);
	if (!$result) { //column 'approved' not present
		$altered = dbQuery("ALTER TABLE ".$calID."_events
			ADD	`approved` TINYINT(1) unsigned NOT NULL DEFAULT '0' AFTER `editor`
		");
	}
	//Set privs to 9 for admin accounts and drop column sedit
	$result = dbQuery("SELECT sedit FROM ".$calID."_users",0);
	if ($result) { //column 'sedit' present
		$result = dbQuery("UPDATE ".$calID."_users
			SET `privs` = 9 WHERE `sedit` = 1
		");
		$result = dbQuery("ALTER TABLE ".$calID."_users
			DROP `sedit`
		");
	}
	//Rename check2, label2, mark2 and drop columns check1, label1, mark1
	//Adapt events.checked ;dd-mm-yyyya -> ;dd-mm-yyyy and delete ;dd-mm-yyyyb
	$result = dbQuery("SELECT `check1` FROM ".$calID."_categories",0);
	if ($result !== false) { //column 'check1' present - perform rename and drop
		$result = dbQuery("ALTER TABLE ".$calID."_categories
			CHANGE `check2` `chbox` TINYINT(1) unsigned NOT NULL DEFAULT '0',
			CHANGE `label2` `chlabel` VARCHAR(40) NOT NULL DEFAULT 'complete',
			CHANGE `mark2` `chmark` VARCHAR(10) NOT NULL DEFAULT '&#10003;'
		");
		$result = dbQuery("ALTER TABLE ".$calID."_categories
			DROP `check1`,
			DROP `label1`,
			DROP `mark1`
		");
		$rSet = dbQuery("SELECT `event_id`,`checked` FROM ".$calID."_events WHERE `checked` != ''");
		while ($row = mysql_fetch_assoc($rSet)) {
			$chBoxed = preg_replace('~;\d\d\d\d-\d\d-\d\db~','',$row['checked']);
			$chBoxed = preg_replace('~(;\d\d\d\d-\d\d-\d\d)a~','$1',$chBoxed);
			dbQuery("UPDATE ".$calID."_events SET `checked`='".$chBoxed."' WHERE `event_id` = ".$row['event_id']);
		}
	}
	//Add columns chbox, chlabel, chmark to categories table
	$result = dbQuery("SELECT `chbox` FROM ".$calID."_categories",0);
	if (!$result) { //column 'chbox' not present
		$altered = dbQuery("ALTER TABLE ".$calID."_categories
			ADD `chbox` TINYINT(1) unsigned NOT NULL DEFAULT '0' AFTER `background`,
			ADD `chlabel` VARCHAR(40) NOT NULL DEFAULT 'approved' AFTER `chbox`,
			ADD `chmark` VARCHAR(10) NOT NULL DEFAULT 'ok' AFTER `chlabel`
		");
	}
	//Add column checked to events table
	$result = dbQuery("SELECT checked FROM ".$calID."_events",0);
	if (!$result) { //column 'checked' not present
		$altered = dbQuery("ALTER TABLE ".$calID."_events
			ADD `checked` TEXT DEFAULT NULL AFTER `private`
		");
	}
	
/* ===== As of LuxCal 3.2.0 ===== */

	//Change name and type of columns a_date and m_date to x_datetime / DATETIME
	$result = dbQuery("SELECT `a_date` FROM ".$calID."_events",0);
	if ($result !== false) { //column 'a_date' present - perform action
		$result = dbQuery("ALTER TABLE ".$calID."_events
			CHANGE `a_date` `a_datetime` DATETIME NOT NULL DEFAULT '9999-00-00 00:00:00',
			CHANGE `m_date` `m_datetime` DATETIME NOT NULL DEFAULT '9999-00-00 00:00:00'
		");
	}
	//Add columns xfield1 and xfield2
	$result = dbQuery("SELECT xfield1 FROM ".$calID."_events",0);
	if (!$result) { //column 'xfield1' not present
		$altered = dbQuery("ALTER TABLE ".$calID."_events
			ADD `xfield1` TEXT DEFAULT NULL AFTER `description`,
			ADD `xfield2` TEXT DEFAULT NULL AFTER `xfield1`
		");
	}
	echo "<li>Database tables and structures verified.</li>\n";
	echo "</ul></li>\n";
} //end of: do for all calendars in this db

//Save LuxCal version and db credentials to lcconfig.php
$lcconfig = '<?php
/*
= LuxCal event calendar configuration =

� Copyright 2009-2014 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/
$lcc="'.$lcVersion.'"; //current LuxCal version
$dbHost="'.$dbHost.'"; //MySQL server
$dbUnam="'.$dbUnam.'"; //database username
$dbPwrd="'.$dbPwrd.'"; //database password
$dbName="'.$dbName.'"; //database name
$dbPfix="'.$dbPfix.'"; //db table name prefix (default calendar)
?>';

//if (file_put_contents($_SERVER['DOCUMENT_ROOT'].'/../roel/lxconfig.php',$lxconfig) === false) { //save config data file above web dir
if (file_put_contents('./lcconfig.php',$lcconfig) === false) {
	exit('Unable to write the file lcconfig.php to disk. Check the permissions of the calendar root directory (should be 755).');
}
//unlink('./lcconfig.php');
echo "<li>Configuration file 'lcconfig.php' updated and saved to root folder.</li>\n";
echo "</ul>\n";
echo "<h5>End of Upgrade</h5>\n";
echo "<div class='centerBox'>The calendar has been upgraded to version {$lcVersion}.\n";

//rename old files with config data
if (file_exists('./lcaldbc.dat')) {
	rename('lcaldbc.dat', 'lcaldbc-backup.dat');
	echo "<p>The file 'lcaldbc.dat' has been renamed to 'lcaldbc-backup.dat' and should be removed from the server.</p>";
} elseif (file_exists('./config.php')) {
	rename('config.php', 'config-backup.php');
	echo "<p>The file 'config.php' has been renamed to 'config-backup.php' and should be removed from the server.</p>";
}
echo "<p>Make a back-up copy of the configuration file 'lcconfig.php'.</p>\n";
echo "<div class='center'>\n";
echo "<input type='button' onclick=\"window.location.href='index.php'\" value=\"Start Calendar\">\n";
echo "</div>\n</div>\n";
?>
</div>
<br>
<div class="bLine mark"><h4>AFTER SUCCESSFUL UPGRADE REMOVE THE FILE <?php echo basename(__FILE__); ?> FROM THE SERVER!</h4></div>
<div class="endBar">
	design 2014 - powered by <a href="http://www.luxsoft.eu"><span class="footLB">Lux</span><span class="footLR">Soft</span></a>
</div>
<br>&nbsp;
</body>
</html>
