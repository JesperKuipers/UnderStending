<?php

function AddVideoToDatabase($video)
{
	//Creëer query
	$statement = "insert into video values (0, ?, ?, '', ?, ?, 0, ?, ?)";	
	//Creëer query parameters
	$parameters = array(
		$video->userId,
		$video->title,
		$video->description,
		$video->urlId,
		$video->thumbnailId,
		$video->thumbnailExtension
	);
	//Voeg video toe aan database
	return Execute($statement, $parameters, "isssss");
}

function GetVideoById($videoId)
{
	//Haal videos op uit database
	$result = Fetch("select * from video where videoid = ?", array($videoId), "i");
	//Pak user uit users array
	$row = $result[0];
	//Creëer nieuw user object
	$video = new Video();
	//Wijs waardes toe aan user object
	$video->videoId = $row[0];
	$video->userId = $row[1];
	$video->title = $row[2];
	$video->releaseDate = $row[3];
	$video->description = $row[4];
	$video->urlId = $row[5];
	$video->approved = $row[6];
	$video->thumbnailId = $row[7];
	$video->thumbnailExtension = $row[8];
	//Geef video object terug aan functie caller
	return $video;
}

function GetRatingsByVideoId($videoId)
{
	//Haal ratings op uit database
	$result = Fetch("select * from rating where videoid = ?", array($videoId), "i");
	//Lus door de rows
	$ratings = array();
	foreach ($result as $row)
	{
		//Creëer een nieuw rating object
		$rating = new Rating();
		$rating->videoId = $row[0];
		$rating->userId = $row[1];
		$rating->rating = $row[2];
		//Voeg de rating toe aan alle ratings
		$ratings[] = $rating;
	}
	//Geef alle ratings terug
	return $ratings;
}

function RemoveVideoFromDatabase($videoId)
{
	Execute("delete from video where videoid=?", array($videoId), "i");
}

?>