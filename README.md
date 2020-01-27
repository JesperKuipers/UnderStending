[UnderStending]

1. Zet alle files in de root directory van je webserver
2. Maak een sql database genaamd "understendingdb" aan
3. Importeer /understendingdb/understendingdb.sql in de lege understendingdb database
4. In je php.ini bestand, verander variabelen post_max_filesize en post_max_size naar 100M

--------------------------------------------------------

[Verzenden van de mail instellen]
[php.ini]
Ga naar [mail function]
vervang alles onder de [mail function] naar:

SMTP=smtp.live.com
smtp_port=587
sendmail_from = understending@hotmail.com
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
mail.add_x_header=Off

--------------------------------------------------------

[sendmail.ini]
Ga naar [sendmail.ini]
Vervang alles in [sendmail.ini] naar:

smtp_server=smtp.live.com
smtp_port=587
smtp_ssl=auto
error_logfile=error.log
debug_logfile=debug.log
auth_username=understending@hotmail.com
auth_password=cdc09726-8153-4892-9898-584283785c27