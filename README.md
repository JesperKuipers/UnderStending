[UnderStending]

1. Zet alle files in de root directory van je webserver
2. Maak een sql database genaamd "understendingdb" aan
3. Importeer /understendingdb/understendingdb.sql in de lege understendingdb database
4. In je php.ini bestand, verander variabelen upload_max_filesize en post_max_size naar 100M

--------------------------------------------------------

[Verzenden van de mail instellen]

1. Ga naar xampp/php/php.ini op het filesysteem
2. Ga naar [mail function]
3. vervang alles onder de [mail function] naar:

SMTP=smtp.live.com
smtp_port=587
sendmail_from = understending@hotmail.com
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"
mail.add_x_header=Off


4. Ga naar xampp/sendmail/sendmail.ini
5. Ga naar [sendmail]
6. Vervang alles onder de [sendmail] naar:

smtp_server=smtp.live.com
smtp_port=587
smtp_ssl=auto
error_logfile=error.log
debug_logfile=debug.log
auth_username=understending@hotmail.com
auth_password=cdc09726-8153-4892-9898-584283785c27

<!--
Wanneer er geen folder in xampp zit genaamd sendmail
zal xampp opnieuw geinstalleerd moeten worden en daarbij moet
fake sendmail aangevinkt worden bij de installatie opties.
-->