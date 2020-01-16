<?php
	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$timestamp = $_POST['action'];
		$videoID = $_POST['action1'];
		$userID = $_POST['action2'];
		include_once("core/functions.php");
		CreateOrUpdateCurrentlyWatching($videoID, $userID, $timestamp);
		
		//echo $timestamp . "<br>";
		//echo $videoID . "<br>";
		//echo $userID . "<br>";
	}
?>