GraphMailbox
============

Tracks and graphs the number of emails in your mailbox / inbox.

The output will look something like - http://hamlesh.com/graphbox

GraphMailbox is something that I’ve hacked together, I just needed
a simple way to get some metrics from my primary inbox.  I tend to
use my inbox as a "things to-do/look at" list.  Always chasing
inbox zero, the on-going graphing is just a way for me track my
progress.

Please feel free to fork, update, change, modify etc.  If you build
something useful or add more functionality, please ping me.  I've
tried to comment the code as much as possible.

This is not production code, use at your own risk etc.


Requirements
============
- PHP / MySQL capable hosting/server
- php-imap module installed and enabled (aptitude install php5-imap)
- Ability to create scheduled/cron jobs (php-cli maybe)


Getting Started
===============
- Create a database on your mysql server
- Extract/Import sql from graphbox-sql.zip into the database, this 
  will create a single table (called inbox)
- Update conf/db.php with your mysql details
- Update conf/imap.php with your IMAP info
- Setup an hourly cron job to call "php path/on/your/server/cron.php"
- Send me a message/tweet (@hamlesh) to let me know you've done it

PS: I'd rename cron.php to something more obscure if I were you.


Notes
=====
The hourly cron job will call cron.php, this will connect to your IMAP
server based on your settings, get the total number of items (read+unread)
and log this in the database.  I've logged the Year, Month, Date, Hour,
Min, TimeStamp seperately as this gives more flexibility to play around
when dreaming up more ways to visuliase the data.

Use index.php to simply pull in graph pages.  The logic behind keeping
each graph as a separate page means that they can be called in iframes
from any other site.

Create additional graphs using the existing graph pages as templates.
Work out the SQL query, and then how to display the information using the
Google Chart API.

Again, please let me know what you build using this, and the reasons
behind it.  I honestly want to know!


Contact
=======
See hamlesh.com for all my contact info.

For help/pointers, ask me on twitter (@hamlesh).
