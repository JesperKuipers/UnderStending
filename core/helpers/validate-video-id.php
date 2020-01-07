<?php
function getVideoID() {
	if(isset($_GET["v"])) {
		$videoID = filter_input(INPUT_GET, 'v', FILTER_VALIDATE_INT);
		if (!$videoID) {
			return false;
		} else {
			return $videoID;
		}
	}
	else if(isset($_GET["id"])) {
		$videoID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		if (!$videoID) {
			return false;
		} else {
			return $videoID;
		}
	}
}
