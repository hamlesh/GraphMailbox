<!-- Created using code from: https://github.com/hamlesh/GraphMailbox //-->
<?
/*
	You need to configure your database authentication settings below;
	dbuser: username to connect to database
	dbpass: password to connect to database
	dbserver: servername/path to talk to database (for majority it will be localhost)
	dbname: the name of the database you've created for GraphMailbox
*/
$dbuser = "SET-USERNAME";
$dbpass = "SET-PASSWORD";
$dbserver = "localhost";
$dbname = "SET-DATABASE";

# You shouldn't need to touch anything below

$link = mysql_connect($dbserver, $dbuser, $dbpass);
if (!$link) {
    die('Could not connect to database');
}
$database = mysql_select_db($dbname);
if(!$database){
    die('Could not select database');
}
?>
