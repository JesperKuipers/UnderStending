<?php

function AddVideoToDatabase($video)
{
	//Creëer query
	$statement = "insert into video values (0, ?, ?, '', ?, ?, 0, ?)";	
	//Creëer query parameters
	$parameters = array(
		$video->userId,
		$video->title,
		$video->description,
		$video->urlId,
		$video->thumbnailId
	);
	//Voeg video toe aan database
	return Insert($statement, $parameters, "issss");
}

?>