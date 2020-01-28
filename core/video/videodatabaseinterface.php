<?php

function AddVideoToDatabase($video)
{
	//Creëer query
	$statement = "insert into video values (0, ?, ?, '', ?, ?, 0, ?, ?)";	
	//Creëer query parameters
	$parameters = array(
		$video->uploader,
		$video->title,
		$video->description,
		$video->urlId,
		$video->thumbnailId,
		$video->thumbnailExtension
	);
	//Voeg video toe aan database
	if (Execute($statement, $parameters, "isssss"))
	{
		return Fetch("select max(videoid) from video")[0][0];
	}
	else
	{
		return false;
	}
}

function GetVideoById($videoId)
{
	//Haal videos op uit database
	$result = Fetch("select * from video where videoid = ?", array($videoId), "i");
	//Pak user uit users array
	$row = $result[0];
	//Geef video object terug aan functie caller
	return ConvertRowToVideo($row);
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

function UpdateVideoInDatabase($video)
{
	$query = "update video set title=?, releasedate=?, description=?, approved=?, thumbnail=?, thumbnailextension=? where videoid=?";
	
	$params = array(
		$video->title,
		$video->releaseDate,
		$video->description,
		$video->approved,
		$video->thumbnailId,
		$video->thumbnailExtension,
		$video->videoId
	);
	
	return Execute($query, $params, "sssissi");
}

function GetVideosFromDatabase($limit)
{
	$result = Fetch("SELECT * FROM video LIMIT ?", array($limit), "i");
	if (!$result)
	{
		return false;
	}
	else
	{
		$videos = array();
		foreach ($result as $row)
		{
			$videos[] = ConvertRowToVideo($row);
		}
		return $videos;
	}
}

function GetNonApprovedVideosFromDatabase($index, $limit)
{
	$result = Fetch("select * from video where not(approved) limit ?, ?", array($index, $limit), "ii");
	if ($result)
	{
		$videos = array();
		foreach ($result as $row)
		{
			$videos[] = ConvertRowToVideo($row);
		}
		return $videos;
	}
	else
	{
		return false;
	}
}

function GetNonApprovedVideosCountFromDatabase()
{
	$result = Fetch("select count(*) from video where not(approved)");
	if ($result)
	{
		return $result[0][0];
	}
	else
	{
		return false;
	}
}

function GetVideosByUserFromDatabase($userId)
{
	$result = Fetch("select * from video where userid=?", array($userId), "i");
	if ($result === false)
	{
		return false;
	}	
	return ConvertRowsToVideos($result);
}

function ConvertRowsToVideos($rows)
{
	$videos = array();
	foreach ($rows as $row)
	{
		$videos[] = ConvertRowToVideo($row);
	}
	return $videos;
}

function ConvertRowToVideo($row)
{
	$video = new Video();
	$video->videoId = $row[0];
	$video->uploader = $row[1];
	$video->title = $row[2];
	$video->releaseDate = $row[3];
	$video->description = $row[4];
	$video->urlId = $row[5];
	$video->approved = $row[6];
	$video->thumbnailId = $row[7];
	$video->thumbnailExtension = $row[8];
	return $video;
}

?>