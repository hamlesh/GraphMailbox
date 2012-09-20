<!-- Created using code from: https://github.com/hamlesh/GraphMailbox //-->
<?
include ('conf/db.php');
include ('conf/imap.php');

$itemcount = imap_num_msg($mbox);
$lyear = date('Y');
$lmonth = date('m');
$lday = date('d');
$lhour = date('H');
$lmin = date('i');

# its important to close the IMAP connection once data has been collected
imap_close($mbox);

$sql = "INSERT INTO inbox (`LID`, `LogYear`, `LogMonth`, `LogDate`, `LogHour`, `LogMin`, `LogCount`, `LTS`)
				VALUES (NULL, $lyear, $lmonth, $lday, $lhour, $lmin, $itemcount, NULL)";

mysql_query($sql);
?>

