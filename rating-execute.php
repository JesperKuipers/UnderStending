<?php
	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$rating = $_POST['action'];
		$videoID = $_POST['action1'];
		$userID = $_POST['action2'];
		include_once("core/functions.php");
		
		$query = "SELECT * FROM rating WHERE videoID = ? AND userID = ?";
		$result = Fetch($query, array($videoID, $userID), "ii");
		
		if(empty($result)) {
			addRating($videoID, $userID, $rating);
		}
		//var_dump($_POST);
	}
?>