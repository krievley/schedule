<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LuxCal Installation and Configuration Guide</title>
<meta name="description" content="LuxCal web calendar - a LuxSoft product">
<meta name="keywords" content="LuxSoft, LuxCal, LuxCal web calendar">
<meta name="author" content="Roel Buining">
<meta name="robots" content="nofollow">
<!--[if IE]><link rel="shortcut icon" href="lcal.ico"><![endif]-->
<link rel="icon" href="lcal.ico">
<style type="text/css">
* {padding:0; margin:0;}
body {
	font: 12px arial, helvetica, sans-serif;
	background: #E0E0E0;
	color: #2B3856;
}
a {text-decoration:none; cursor:pointer;}
h1 {font-size:18pt; text-shadow:grey 0.2em 0.3em 0.2em;}
h3 {margin:20px 0 10px 0; font-size:14pt;}
h4 {margin:30px 0 6px 0; font-size:12pt;}
h5 {margin:15px 0 0 0; font-size:10pt;}
h6 {margin:10px 0 0 0; font-size:9pt;}
p { margin:6px 0; }
ul, ol {margin:0 20px;}
ol ol {list-style-type:lower-alpha;}
code {display:table; line-height:1.5; background:#FFFFFF;}
.top {background:#F2F2F2;	padding:10px;}
.floatR {float:right;}
.center {text-align:center;}
.marginLR {margin:0 40px;}
.redFlag {color:#DD3300;}
.footLB {font:italic bold 1.1em arial,sans-serif; color:#0033FF;}
.footLR {font:italic bold 1.1em arial,sans-serif; color:#AA0066;}
.navBar {
	width:100%;
	background:#AAAAFF;
	padding:2px 10px;
	border-top:1px solid #808080;
	border-bottom:1px solid #808080;
	line-height:20px;
	vertical-align:middle;
}
.endBar {
	clear:left;
	background:#AAAAFF;
	padding:0px 10px;
	text-align:right;
	border-top:1px solid #808080;
	border-bottom:1px solid #808080;
	font-size:0.8em;
}
.content {padding:10px;}
</style>
</head>

<body>
<div class="top">
<h5 class="floatR">a LuxSoft product</h5>
<h1>LuxCal Event calendar</h1>
</div>
<div class="navBar">&nbsp;</div>
<div class="content marginLR">

<h3 class="center">Installation Guide</h3>
<!--
<br>
<center><h4 class="redFlag">THIS IS NOT THE LATEST VERSION OF LUXCAL</h4></center>
<center><h4 class="redFlag">FOR THE LATEST VERSION GO TO <a href="http://www.luxsoft.eu">LUXSOFT</a></h4></center>
<br>
-->
<h4>Table of Content</h4>
<ol style="margin:0 40px">
<li><p><a href="#lbl-1">Installation of Updates</a></p></li>
<li><p><a href="#lbl-2">New Installation</a></p>
<ol>
<li><p><a href="#lbl-2a">Requirements</a></p></li>
<li><p><a href="#lbl-2b">Installation Steps</a></p></li>
<li><p><a href="#lbl-2c">Configuring / Customizing the calendar</a></p></li>
<li><p><a href="#lbl-2d">My Calendar doesn't Work</a></p></li>
</ol></li>
<li><p><a href="#lbl-3">Calendar Configuration</a></p>
<ol>
<li><p><a href="#lbl-3a">LuxCal Version Number and Database Credentials</a></p></li>
<li><p><a href="#lbl-3b">Installing Automatic Periodic Functions</a></p></li>
<li><p><a href="#lbl-3c">Installing a New Language</a></p></li>
<li><p><a href="#lbl-3d">Using SMTP Mail for Reminders and Reports</a></p></li>
</ol></li>
<li><p><a href="#lbl-4">Installing Additional Calendars</a></p>
<ol>
<li><p><a href="#lbl-4a">Calendars with an Individual Database</a></p></li>
<li><p><a href="#lbl-4b">Calendars Sharing the Same Database</a></p></li>
</ol></li>
<li><p><a href="#lbl-5">Adding the Calendar to an Existing Web Page</a></p>
<ol>
<li><p><a href="#lbl-5a">Link to the Calendar</a></p></li>
<li><p><a href="#lbl-5b">Add a Sidebar with Upcoming Events</a></p></li>
<li><p><a href="#lbl-5c">Embed a Mini Calendar</a></p></li>
<li><p><a href="#lbl-5d">Embed the Full Calendar</a></p></li>
<li><p><a href="#lbl-5e">Embed One Specific Calendar View Without Navigation Bar</a></p></li>
<li><p><a href="#lbl-5f">Single Sign On (SSO)</a></p></li>
</ol></li>
</ol>
<br>

<a id="lbl-1"></a><h4>1. Installation of Updates</h4>
<p>To upgrade to a new version of the LuxCal Event Calendar follow the
instructions in the file &quot;<kbd>release_notes_luxcal_xxx.html</kbd>&quot;
(where xxx indicates the release).</p>

<a id="lbl-2"></a><h4>2. New Installation</h4>

<a id="lbl-2a"></a><h5>a. Requirements</h5>
<p>For the installation of the LuxCal Event Calendar on the server of your hosting provider, you will need:</p>
<ul>
<li><p>A web accessible folder on a web server to install the LuxCal files.</p></li>
<li><p>The web server should be able to run PHP-scripts (PHP 5.1 or higher).</p></li>
<li><p>A MySQL database on the web server to store the LuxCal Event Calendar data.</p></li>
</ul>

<a id="lbl-2b"></a><h5>b. Installation Steps</h5>
<p>To install the LuxCal Event Calendar on the server of your hosting provider, follow the next steps:</p>
<ol>
<li><p>Create a MySQL database on the server to store the LuxCal calendar data. Ask your hosting provider
	if they provide a tool for you to do this.</p>
	<p>For later use, remember the name of the database server (host name), the username and password required 
	to log in to the database server and the database name to access the database.</p></li>
<li><p>Download and unzip the latest version of LuxCal (file: <kbd>luxcalxxx.zip</kbd>, where 'xxx' is the 
	version number) in a temporary location. This file contains the following two compressed files: 
	luxcalxxx-calendar.zip and luxcalxxx-toolbox.zip. Unzip the file luxcalxxx-calendar.zip and upload all 
	files and folders to a web accessible folder on the server where you wish to install LuxCal. Keep the 
	file luxcalxxx-toolbox.zip for possible later use.
<li><p>With your Web browser browse to the folder of the LuxCal installation; it will redirect you to the 
	<kbd>install.php</kbd> script and show the Installation page.</p></li>
<li><p>On the Installation page enter the database details and the administrator name, e-mail address 
	and password and click &quot;Install.&quot;  The script will generate the necessary tables in the 
	database and saves your LuxCal version number and the database credentials in a file called 
	<kbd>lcconfig.php</kbd> in the calendar's root folder.</p></li>
<li><p>Launch the calendar by browsing to the calendar's URL to ensure the calendar displays properly.</p></li>
<li><p>Keep a backup copy of the <kbd>lcconfig.php</kbd> file. It contains the LuxCal version number and the 
	parameters for the MySQL database.</p></li>
</ol>
<p>Note: The file luxcalxxx-toolbox.zip (see step 2 above) contains the LuxCal tools which should be kept 
	for later use and which should be uploaded to the calendar root folder only when needed.</p>
<a id="lbl-2c"></a><h5>c. Configuring / Customizing the Calendar</h5>
<p>The Settings page in the administrator's menu on the navigation bar can be used to easily change the
	calendar's configuration settings which are stored in the <kbd>settings</kbd> table of the database.
	These settings, for instance, define the calendar title, the time zone, the language file to be used for
	the user interface, the default initial view when the calendar is started, the number of weeks/months
	displayed in the various views, the date and time format, and many other things.</p>
<p>IMPORTANT: Currently the TimeZone is set to &quot;Europe/Amsterdam&quot;. If you are in a different time
	zone, change the TimeZone to your local time zone. See the
	<a href="http://us3.php.net/manual/en/timezones.php">PHP Supported Timezones</a> for possible values.</p>
<p>The user interface style (colors, fonts, etc.) can be customized by editing the lctheme.php file in the 
	css folder. This can be particularly useful when the calendar is embedded in an existing web page and 
	should match the parent web page style.</p>

<a id="lbl-2d"></a><h5>d. My Calendar doesn't Work</h5>
<p>The two most frequent problems are:</p>
<ul>
<li><p>The calendar shows a blank page. Most of the time this problem is caused by the fact that the
	calendar cannot connect to the MySQL database.</p></li>
<li><p>When logging in as administrator, your name is not displayed at the right top of the window;
	instead it reads 'Public View'. This problem occurs when 'sessions' are not enabled, or not working,
	in the PHP installation on your server. This problem also occurs when cookies are not enabled in
	your browser.</p></li>
</ul>
<p>With the lctools.php script, which you can find in the LuxCal toolbox, you can check if your LuxCal 
calendar installation is ready for use or to further analyse above problems</p>

<a id="lbl-3"></a><h4>3. Calendar Configuration</h4>

<a id="lbl-3a"></a><h5>a. LuxCal Version Number and Database Credentials</h5>
<p>During the LuxCal installation process a file called <kbd>lcconfig.php</kbd> is created and stored in
the root folder of the calendar. If, when launching the calendar, the file <kbd>lcconfig.php</kbd> is
not present in the calendar's root folder, it is assumed the calendar has not yet been installed and
consequently the calendar's installation script will be started.</p>
<p>The file <kbd>lcconfig.php</kbd> contains the following data (in the form of PHP variables):</p>
<ol>
<li><p>The version number of the LuxCal installation. For example "3.2.0". This version number is used
		by the calendar to check if the current calendar installation is up-to-date with the installed
		calendar files and to determine if the upgrade script should be run.</p></li>
<li><p>The following database credentials:</p>
<ul>
<li><p><kbd>host name:</kbd> This is the name of the database server and is often called "localhost".</p></li>
<li><p><kbd>user name:</kbd> The database user name is the user name required to connect to the
		database. This user name was chosen when the database was created on the server of your ISP. Note:
		This user name should not be confused with the admin's user name to log in to the calendar!</p></li>
<li><p><kbd>password:</kbd> The database password is the password required to connect to the
		database. This password was chosen when the database was created on the server of your ISP. Note:
		This password should not be confused with the admin's password to log in to the calendar!</p></li>
<li><p><kbd>database name:</kbd> This is the name of the database on the database server which will
		be used by the LuxCal calendar to store all its data. The calendar data is stored in the following
		tables: <kbd>events</kbd>, <kbd>users</kbd>, <kbd>categories</kbd> and <kbd>settings</kbd>.</p></li>
<li><p><kbd>table prefix:</kbd> This variable is used as a prefix for the database table names. If only 
		one calendar has been installed, this prefix will automatically be set to 'mycal'.
		If more than one calendar has been installed sharing the same MySQL database, this table prefix is 
		the one for the default calendar.</p></li>
</ul>
</li>
</ol>

<a id="lbl-3b"></a><h5>b. Installing Automatic Periodic Functions</h5>
<p>The following automatic periodical functions are available:</p>
<ul>
<li>Email notification messages for event due dates</li>
<li>Daily email messages with calendar changes</li>
<li>Daily export of events in iCalendar format</li>
<li>Automatic deletion of expired events</li>
<li>Automatic deletion of expired (unused) user accounts</li>
</ul>
<p>To make the automatic periodical functions work, a cron job needs to be created on the server (or
on an external server), which executes the file <kbd>lcalcron.php</kbd>, in the root folder of the
calendar, daily at approx. 2:00am. For cron job details see the header of the <kbd>lcalcron.php</kbd>
file.</p>
<p>If you are not familiar with cron jobs, ask your hosting provider for help.</p>

<h6>- The Email Notification Feature</h6>
<p>For events entered in the calendar the user can choose to receive an email reminder (notification)
one or several days before the event is due. When chosen, for recurring events (e.g. birthdays) an email
notification will be sent to the user the selected number of days before each occurrence of the event.
Imagine: never forget to buy flowers for your (girl)friend's birthday anymore!</p>
<h6>- Receiving Calendar Changes by Email</h6>
<p>In a multi-user environment it could be useful to be aware of changes being applied to the calendar
content, i.e. a list with events added, edited and deleted. Such a list can be called up via the
options panel. It is however also possible to have a list with changes automatically sent daily to one
or more email addresses.</p>
<p>Via the Settings page the administrator can specify the number of days to look back for changes and
a list with email addresses. If the number of days to look back for changes is set to 0 (zero), no
emails with changes will be sent.</p>
<h6>- Daily Export of Events in iCalendar format</h6>
<p>When enabled on the admin's Settings page, each day a file in iCalendar format (.ics extension) will 
be created in the 'files' folder with all events occurring in the time range -1 week until +1 year. 
These files can be imported by other calendar applications. The name of the file is the calendar name 
with the characters ' ','/','\','?','*',':',';','{','}' replaced by an underscore and diacritics removed. 
A new file will overwrite the previous one. </p>
<h6>- Automatic Deletion of Expired Events</h6>
<p>Events which due date has past can automatically be deleted. Via the Settings page the administrator
can specify the number of days after an event's due date when an event will automatically be deleted.
If the number of days is set to 0 (zero), no events will be deleted.</p>
<p>Note: deleted events are flagged "deleted"; definitively removing deleted events from the database
is done via the admin's Database page. </p>
<h6>- Automatic Deletion of Expired (unused) User Accounts</h6>
<p>The account of users who have not logged in during a certain number of days can automatically be
deleted. Via the Settings page the administrator can specify the number of 'no login' days after which
the user account will be deleted. If the number of 'no login' days is set to 0 (zero), no user accounts
will be deleted.</p>
<p>This function can be particularly useful when users are allowed to self-register (this feature can
be switched on/off on the admin's Settings page).</p>

<a id="lbl-3c"></a><h5>c. Installing a New Language</h5>
<p>= Note: in the following text the part {language} (including the braces) of the file names represents
		the name of the relevant language. =</p>
<p>A new language for the user interface of the LuxCal calendar can be installed as follows:</p>
<ul>
<li>Download and unzip the desired language pack from the LuxSoft site.
<p>If your language pack is not available:</p>
<ul>
<li><p>translate the files <kbd>lang/ai-english.php</kbd> and <kbd>lang/ui-english.php</kbd> (translate
		the texts to the right of the => signs) and save the files with the names <kbd>ai-{newlang}.php</kbd>
		and <kbd>ui-{newlang}.php</kbd> respectively.<br>
		Use character encoding <strong>utf-8 without BOM</strong> (see note below).</p></li>
<li><p>translate the file <kbd>lang/ug-english.php</kbd> (leave the html tags unchanged) and save it with
		the name <kbd>ug-{newlang}.php</kbd>.<br>
		Use character encoding <strong>utf-8 without BOM</strong> (see note below).</p></li>
</ul>
</li>
<li><p>upload the files <kbd>ai-{newlang}.php</kbd>, <kbd>ui-{newlang}.php</kbd> and
		<kbd>ug-{newlang}.php</kbd> to the <kbd>lang/</kbd> folder on the server.</p></li>
<li><p>on the Settings page (see Calendar Configuration Settings in Section 4 below), change the user
		interface language in the Calendar Settings to the new language.</p></li>
<li><p>if the user interface language menu is displayed in the calendar's options panel, the new installed
		language will automatically be added to the menu.</p></li>
</ul>
<p><b>IMPORTANT NOTE:</b> When using special characters (e.g. accents) in the language files, the ui and
		ug files can best be saved with character encoding: <kbd>utf-8 without BOM</kbd> (BOM = Byte Order Mark).
		If your text editor does not support <kbd>utf-8 without BOM</kbd>, you can download and use Notepad++
		(<a href="http://notepad-plus.sourceforge.net/uk/site.htm">Notepad++ on Sourceforge</a>). This is an 
		excellent free text editor!</p>

<a id="lbl-3d"></a><h5>d. Using SMTP Mail for Reminders and Reports</h5>
<p>Reminder emails and email reports (triggered by a cron job) are sent by default via the PHP mail system.
		If however, email authentication is required, the admin can choose on the Settings page, under General, 
		to use an SMTP mail server.</p>
<p>Before choosing SMTP mail on the admin's Settings page, the following SMTP mail server parameters must 
		be specified on the Settings page:</p>
<ul>
<li>SMTP server address</li>
<li>SMTP port number (often port 25 or, if SSL enabled, 465.</li>
<li>SSL (Secure Socket Layer) enabled/disabled</li>
<li>SMTP server user name</li>
<li>SMTP server password</li>
</ul>
<p>Note: TLS (Transport Layer Security) is not supported.</p>
<p>If you don't know what parameters to use, ask your mail provider for the correct parameters.</p>
<p>Example: To use a gmail SMTP server with your "my.mail@gmail.com" email address, the SMTP settings on
		the Settings page should be as follows:</p>
<ul>
<li>SMTP server address: smtp.gmail.com</li>
<li>SMTP port number: 465</li>
<li>SSL (Secure Socket Layer): enabled</li>
<li>SMTP server user name: my.mail</li>
<li>SMTP server password: mygmailpassword</li>
</ul>
<p>The tool called "smtptest.php", which you can find in the LuxCal toolbox, can be used to test the SMTP 
settings specified on the Settings page.</p>

<a id="lbl-4"></a><h4>4. Installing Additional Calendars</h4>
<p>During the initial installation of the calendar one calendar will be installed in your MySQL database.
The tables of this calendar will be prefixed with the string "mycal_" and the calendar title will be "My 
Web Calendar".</p>
<p>There are two ways to add additional calendars:</p>
<ol>
<li>After the initial installation, install the calendar a second time, a third time, etc., each 
time in it's own folder. This way of installing will require a MySQL database per calendar. To upgrade 
later to a newer calendar version, you will have to upgrade each individual calendar.</li>
<li>After the initial installation, use the LuxCal tool <kbd>lctools.php</kbd> from the LuxCal toolbox 
and launch the tool via your browser. This tool can very efficiently create additional calendars, 
sharing the same database by prefixing the calendar tables with a unique text string per calendar. To 
upgrade later to a newer calendar version, you will only have to upgrade one installation.</li>
</ol>

<a id="lbl-4a"></a><h5>a. Calendars with an Individual Database</h5>
<p>To install more than one calendar, each calendar using its own database, the installation steps described 
in section 2 should be repeated for each calendar. For each next calendar, a new MySQL database should be 
created and the calendar should be installed in a new folder.</p>
<p>This process can be repeated as many times as needed. The disadvantage of installing several individual 
calendars however is that you will need one MySQL database per calendar and when upgrading to a new calendar 
version, each individual calendar needs to be upgraded.</p>
<p>The different calendars can be started by browsing to the relevant calendar folders.</p>

<a id="lbl-4b"></a><h5>b. Calendars Sharing the Same Database</h5>
<p>To install additional calendars, all sharing the same database, should be done via the toolbox tools 
'lctools.php'. This file is part of the LuxCal toolbox and should be uploaded to the calendar root folder 
and be started via your browser. When selecting one of the available tools a dedicated explanation will be 
displayed, with detailed instructions on how to use the selected tool.</p>
<p>The advantages of installing multiple calendars sharing the same database are: Only one single database 
is needed and when upgrading to a newer LuxCal version, just one single upgrade for all calendars.</p>
<p>One calendar will be set as the default calendar. This calendar will start when browsing to the calendar 
folder. The other calendars can be started by adding '?cal=xxx' to the calendar URL, where 'xxx' is the 
calendar ID.</p>

<a id="lbl-5"></a><h4>5. Adding the Calendar to an Existing Web Page</h4>
<p>To use the calendar on an other web site, the following possibilities are available:</p>
<ul>
<li><p>link to the calendar's URL, which will open the calendar in a new page.</p></li>
<li><p>Add an Upcoming Events Sidebar. This light-weight list shows all public events for the coming x days.</p></li>
<li><p>embed a mini calendar, which can be used to view events and - if enabled by the admin - add, edit
and delete events.</p></li>
<li><p>embed the full calendar with navigation bar, which the visitor can use to change the options the
calendar.</p></li>
<li><p>embed one specific calendar view without navigation bar. The visitor cannot navigate to other views
and cannot change the options of the calendar</p></li>
</ul>
<a id="lbl-5a"></a><h5>a. Link to the Calendar</h5>
<p>To link to the LuxCal calendar in an existing web page and open it in a new window, the following HTML
code can be used:</p>
<code>&lt;a href="http://www.mycalsite.xx/luxcal/" target="_blank"&gt;Go To My Calendar&lt;/a&gt;</code>
<a id="lbl-5b"></a><h5>b. Add a Sidebar with Upcoming Events or ToDo list</h5>
<p>A sidebar with public upcoming events or a ToDo list for the coming x days can be added to your web page.
 The sidebar is placed in a &lt;div&gt;-tag container, can be placed at any location and is fully customizable. 
An example is shown on the LuxCal Demo page of the LuxSoft web site. The sidebar can be added to your web 
page by adding the following lines of code to the &lt;head&gt;-section of your web page:</p>
<code>&lt;link rel="stylesheet" type="text/css" href="mycalendarfolder/css/css_sbar.php"&gt;</code>
<code>&lt;script type="text/javascript" src="mycalendarfolder/common/toolbox.js"&gt;&lt;/script&gt;</code>
<p>and adding the following lines of code to the body of your web page:</p>
<code>&lt;?php</code>
<code>$sbClass = {sidebar class}; <span class='redFlag'>*</span></code>
<code>$sbContent = {sidebar content}; <span class='redFlag'>*</span></code>
<code>$sbHeader = {sidebar title}; <span class='redFlag'>*</span></code>
<code>$sbCatsIn = {list of categories to include}; <span class='redFlag'>*</span></code>
<code>$sbCatsEx = {list of categories to exclude}; <span class='redFlag'>*</span></code>
<code>$sbUsersIn = {list of users to include}; <span class='redFlag'>*</span></code>
<code>$sbUsersEx = {list of users to exclude}; <span class='redFlag'>*</span></code>
<code>$sbMaxNbr = {max. number of events to show}; <span class='redFlag'>*</span></code>
<code>$sbUpDays = {max. number of days to show}; <span class='redFlag'>*</span></code>
<code>$sbCal = {calendar ID}; <span class='redFlag'>*</span></code>
<code>include './mycalendarfolder/lcsbar.php';</code>
<code>?&gt;</code>
<p><span class='redFlag'>*</span> These parameters are optional and can be omitted. See explanation hereafter.</p>
<p>Explanation of the lines of code:</p>
All parameters indicated by {....}, including the braces, are text strings between single or double quotes.
<ul>
<li><kbd>&lt;?php</kbd>: start PHP and <kbd>?&gt;</kbd>: end PHP. If the lines of code are added to a PHP section,
these PHP-tags can be omitted.</li>
<li><kbd>$sbClass</kbd>: This is the class of the container &lt;div&gt;-tag which is used in the CSS to define the style
for the sidebar container. This line of code is optional and will default to 'sideBar'. The styles for 'sideBar'
are defined in the file <kbd>css/css_sbar.php</kbd> of your calendar installation.</li>
<li><kbd>$sbContent</kbd>: This variable defines the content of the sidebar. If its value is 'todo', the sidebar 
will show the ToDo list, which is a list with events requiring an action. In this case an interactive checkbox is 
displayed in front of each event which can be checked/unchecked by each visitor. This line of code is optional and 
when omitted the sidebar content will default to the upcoming events list.</li>
<li><kbd>$sbHeader</kbd>: The title of the sidebar. This line of code is optional. If not specified, the title of the
sidebar will be taken from the language files.</li>
<li><kbd>$sbCatsIn</kbd>: This is a list with one or more event category sequence numbers (see admin's Categories page) 
that should be included in the sidebar. The sequence numbers should be separated by commas. This line of code is 
optional. If not specified, all event categories will be included.</li>
<li><kbd>$sbCatsEx</kbd>: This is a list with one or more event category sequence numbers (see admin's Categories page) 
that should be excluded from the sidebar. The sequence numbers should be separated by commas. This line of code is 
optional. If not specified, no event categories will be excluded. If $sbCatsIn has been specified, this line of code 
will be ignored.</li>
<li><kbd>$sbCal</kbd>: This is the calendar ID, which is the prefix to be used for the MySQL database table names. If not
specified, the prefix will be taken from the file lcconfig.php, which was specified during the calendar installation.</li>
<li><kbd>$sbUsersIn</kbd>: Same as $sbCatsIn, but for calendar user IDs (for user IDs see admin's Users page).</li>
<li><kbd>$sbUsersEx</kbd>: Same as $sbCatsEx, but for calendar user IDs (for user IDs see admin's Users page).</li>
<li><kbd>$sbMaxNbr</kbd>: Maximum number of events to show in the sidebar.</li>
<li><kbd>$sbUpDays</kbd>: Maximum number of day to show. If not specified, the number of "Days to look ahead in sidebar" 
from the admin's Settings page will be taken</li>
<li><kbd>$sbCal</kbd>: The ID of the calendar to be used. If not specified, the default calendar will be taken.</li>
<li><kbd>include</kbd>: At this place the sidebar code will be included.</li>
</ul>
<p>In the above lines of code you should replace <kbd>mycalendarfolder</kbd> by the name of the root folder of your 
calendar installation.</p>
<p>The file <kbd>css_sbar.php</kbd> contains the default style for the sidebar container &lt;div&gt;, which should be
tailored to your needs. In the same file you can customize the style, colors, fonts, etc. of the sidebar content.
The title of the sidebar can be set per sidebar and the events in the sidebar can be filtered on the event
sequence number and/or user ID. This allows for more than one sidebar per site, each with its own title and a
different list of events.</p>
<p>Example of two sidebar definitions for the same website which are complementary:</p>
<code>&lt;?php</code>
<code>$sbClass = 'sideBar1';</code>
<code>$sbHeader = 'Birthdays/Holidays';</code>
<code>$sbCatsIn = '2,4';</code>
<code>include './mycalendarfolder/lcsbar.php';</code>
<code>?&gt;</code>
<code>&lt;?php</code>
<code>$sbClass = 'sideBar2';</code>
<code>$sbHeader = 'All other events';</code>
<code>$sbCatsEx = '2,4';</code>
<code>$sbUpDays = '7';</code>
<code>include './mycalendarfolder/lcsbar.php';</code>
<code>?&gt;</code>
<p>For each event the following will be displayed: date, time and title. Via the admin's Settings page, under 
"Stand-Alone Sidebar", you can choose whether further event details should be shown in a pop-up box (like in 
the full LuxCal calendar) when hovering an event and if URLs from the event description (if any) should be 
displayed in the sidebar as a hyperlink. On the same Settings page you can specify the number of days to look 
ahead for events in the sidebar.</p>
<p>The sidebar is using the database and tools of the full calendar and therefore the full calendar should be
present in the "mycalendarfolder" (see code above).</p>
<a id="lbl-5c"></a><h5>c. Embed a Mini Calendar</h5>
<p>A mini calendar with a (minimum) width of 160px can be embedded in your web site. An example is shown on
the LuxCal Demo page of the LuxSoft web site. The mini calendar can be displayed in an inline frame (iframe)
using the following HTML code:</p>
<code>&lt;iframe id="lcmini" src="http://www.mysite.xx/luxcal/lcmini.php"&gt;&lt;/iframe&gt;</code>
<p>Via the CSS styles of your site, the id <kbd>lcmini</kbd> can be used to position and define the style of the
iframe containing the mini calendar. The style for id <kbd>lcmini</kbd> could for instance look as follows:</p>
<code>#lcmini { position:absolute; right:100px; top:15%; width:210px; height:233px; overflow:hidden;}</code>
<p>If you want the height of the mini calendar to vary automatically depending on the month to display (4, 5 or
6 weeks) you should add the following JavaScript code, which dynamically adjusts the height of the iframe, to the
<kbd>&lt;head&gt;</kbd> section of the parent web page:</p>
<code>
&lt;script type="text/javascript"&gt; function setHeight(newHeight){var plus=(document.all)?8:0; document.getElementById('lcmini').style.height=newHeight+plus+'px';}&lt;/script&gt;
</code>
<p><b>Please note</b>: Automatic adjusting of the iframe height only works if the calendar is located in the
same domain as the parent page. If not, the iframe height is set to cope with displaying 6 weeks.
</p>
<a id="lbl-5d"></a><h5>d. Embed the Full Calendar</h5>
<p>To embed the full LuxCal calendar in an existing web page, an inline frame (iframe) can be used. This can
for example be done with the following HTML code:</p>
<code>&lt;iframe id="luxcal" src="http://www.mysite.xx/luxcal/?cP=2"&gt;&lt;/iframe&gt;</code>
<p>With parameter <kbd>cP</kbd> the default view can be set (e.g. year: <kbd>cP=1</kbd>, month: <kbd>cP=2</kbd>, . . . ,upcoming:
<kbd>cP=7</kbd>)<br>
<p>Via the CSS styles of your site, the id <kbd>luxcal</kbd> can be used to position and define the style of the
iframe containing the luxcal calendar. The style for id <kbd>luxcal</kbd> could for instance look as follows:</p>
<code>#luxcal { width:80%; height:800px; margin:20px; border-style:solid; border-width:1px; border-color:grey; }</code>
<a id="lbl-5e"></a><h5>e. Embed One Specific Calendar View without Navigation Bar</h5>
<p>To embed the LuxCal calendar without navigation bar, the parameter <kbd>hdr=0</kbd> should be added to the
URL as follows:</p>
<code>&lt;iframe src="http://www.mysite.xx/luxcal/?hdr=0&amp;cP=2"&gt;&lt;/iframe&gt;</code>
<p>Without navigation bar the visitor will not be able to navigate the calendar and select other views.
The following parameters can be added to select the view to display and the user-interface language:</p>
<ul>
<li><kbd>cP</kbd> to set the view (e.g. year: <kbd>cP=1</kbd>, month: <kbd>cP=2</kbd>, . . . , upcoming:
<kbd>cP=7</kbd>)</li>
<li><kbd>cL</kbd> to set the user-interface language (e.g. French: <kbd>cL=Francais</kbd>). The specified
language must be present in the <kbd>lang/</kbd> folder)</li>
</ul>
<br>
<p>For example the HTML code to show the Upcoming Events page without navigation bar, in the French language
looks as follows:</p>
<code>&lt;iframe id="luxcal" src="http://www.mysite.xx/luxcal/?hdr=0&amp;cP=7&amp;cL=Francais"&gt;&lt;/iframe&gt;</code>
<p>Via the CSS styles of your site, the id <kbd>luxcal</kbd> can be used to position and define the style of the
iframe containing the LuxCal calendar. The style for id <kbd>luxcal</kbd> could for instance look as follows:</p>
<code>#luxcal { width:80%; height:800px; margin:20px; border-style:solid; border-width:1px; border-color:grey; }</code>
<p><b>Important:</b>
<br>
The parameter <kbd>hdr=0</kbd> is remembered via the PHP session mechanism; this means that if you access
the embedded calendar without navigation bar, then thereafter, when accessing your normal (not-embedded)
calendar when your session is still active (max. one hour) you will also see no navigation bar. This can be
solved by adding the parameter <kbd>hdr=1</kbd> to the URL of your normal calendar.</p>
<a id="lbl-5f"></a><h5>f. Single Sign On (SSO)</h5>
<p>When the calendar is embedded in a PHP-based website where users have to log in, users logged in on the
parent website can be logged in to the calendar automatically in a secure way, using PHP sessions.</p>
<p>To achieve this the parent website scripts should:</p>
<ul>
<li>start PHP sessions, if not done already, by adding the following PHP statement to the parent website
PHP script:<br><code>session_start();</code>
PHP sessions must be started before anything is sent out to the browser (like header information), so this
statement must be added somewhere at the start of the script.</li>
<li>save the user name or the user email address in the session variable 'lcUser' by adding the following
statement to the parent website PHP script at any point before the iframe statement with the calendar URL:
<code>$_SESSION['lcUser'] = '&lt;user email&gt;';</code>The part <code>&lt;user email&gt;</code> is a string 
with the user email address which corresponds to the email address required to log the user in to the calendar 
(specified by the admin when the calendar user account was created).</li>
</ul>
<br>
<p>Because PHP session data are stored on the server, the user name / email address are not visible to
the users.</p>
</div>
<br><h5>&nbsp;- End of Installation Guide -</h5>
<br>
<div class="endBar">
	design 2014 - powered by <a href="http://www.luxsoft.eu"><span class="footLB">Lux</span><span class="footLR">Soft</span></a>
</div>
<br>&nbsp;
</body>
</html>
