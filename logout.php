<?php include ("includes/topinclude.php"); ?>

<?php
	session_destroy();
	header ('Location: index.php?logout=true');
?>

<?php include "includes/bottominclude.php" ?>
