<!-- Created using code from: https://github.com/hamlesh/GraphMailbox //-->
<?
/*	
	Connect to your IMAP server, and look at the INBOX.  You can use a similar method to
	inspect other mail folders.  Google search imap_open for other pointers, such as
	connecting to POP3, IMAPS, and gmail (needs extra bits). 
	
	If anyone feels like working out the various methods and adding them below as commented
	options, that would be great - commit the change to a git fork and ping me an email/message.
*/

# this method connects to the standard IMAP service on an Exchange server
# imap.hamlesh.com is just an example of a server address - not my actual mailserver :p
$imap_server = "{imap.hamlesh.com:143/novalidate-cert}";

# your IMAP username (for an Exchange server you need to use the format DOMAIN\username)
$imap_user = "SET-USERNAME";

# your IMAP password
$imap_pass = "SET-PASSWORD";

# the mail folder you want to track
$imap_folder = "INBOX";

$mbox = imap_open("{$imap_server}$imap_folder", $imap_user, $imap_pass);
?>
