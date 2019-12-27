<?php

//Geeft terug: boolean (0 = failed, 1 = success)
function Execute($query, $params, $types)
{
	//Creeër connectie
	$conn = mysqli_connect('localhost', 'root', '', 'understendingdb');
	//Stop wanneer connectie faalt
	if (!$conn)
	{
		return false;
	}
	//Voorbereiding query
	if ($stmt = mysqli_prepare($conn, $query))
	{
		//Voeg parameters toe aan query
		if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
		{
			return false;
		}
		//Voer query uit
		if (!mysqli_stmt_execute($stmt))
		{
			return false;
		}
		//Sluit query
		mysqli_stmt_close($stmt);
		//Sluit connectie met db
		mysqli_close($conn);
		//Insert is gelukt geef true terug
		return true;
	}
	else
	{
		return false;
	}
}

//Geeft terug: query gelukt? rows[] niet gelukt? false
function Fetch($query, $params, $types)
{
	//Creeër connectie
	$conn = mysqli_connect('localhost', 'root', '', 'understendingdb');
	//Stop wanneer connectie faalt
	if (!$conn)
	{
		return false;
	}
	//Voorbereiding query
	if ($stmt = mysqli_prepare($conn, $query))
	{
		//Voeg parameters toe aan query
		if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
		{
			return false;
		}
		//Voer query uit
		if (!mysqli_stmt_execute($stmt))
		{
			return false;
		}
		//Haal het resultaat van de query op
		$result = mysqli_stmt_get_result($stmt);
		//Zet het resultaat om in een associatieve array
		$rows = mysqli_fetch_all($result, MYSQLI_NUM);
		//Sluit query
		mysqli_stmt_close($stmt);
		//Sluit connectie met db
		mysqli_close($conn);
		//Geef het resultaat terug aan de caller van deze functie
		return $rows;
	}
}


	
function GenerateGuid()
{
	//Creerd een "GUID" {https://nl.wikipedia.org/wiki/Globally_unique_identifier}		
	mt_srand((double)microtime()*10000);
	$charid = strtoupper(md5(uniqid(rand(), true)));
	$hyphen = chr(45);
	return substr($charid, 0, 8).$hyphen
		.substr($charid, 8, 4).$hyphen
		.substr($charid,12, 4).$hyphen
		.substr($charid,16, 4).$hyphen
		.substr($charid,20,12);
		
	//Voorbeeld: 1e3f9c59-6fed-4479-9446-2dc81e2bbf2c
}

//Bij het creeeren van entiteiten wordt er een nieuwe sleutel gemaakt op basis de functie hierboven.
//Als er een dubbele sleutel is gecreerd wordt er een nieuwe gegenereerd.



class PlaylistVideo
{
	public $videoId;
	public $playlistId;
}



function RemovePlaylistVideos($videoId)
{
	Execute("delete from playlistvideo where videoid=?", array($videoId), "i");
}



class Rating
{
	public $videoId;
	public $userId;
	public $rating;
}



function RemoveRatingsByVideo($videoId)
{
	Execute("delete from rating where videoid=?", array($videoId), "i");
}



function CreateTag($userId, $name, $description)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of de gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Kijk of de tag al bestaat
	if (TagNameExists($name))
	{
		return false;
	}
	//Add tag
	AddTagToDatabase($name, $description);
}



function RemoveTag($userId, $tagId)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Verwijder videotags afhankelijk van de te verwijderen tag
	RemoveVideoTagsByTag($tagId);
	//Verwijder tag
	RemoveTagFromDatabase($tagId);
}



class Tag
{
	public $tagId;
	public $name;
	public $description;
}



function TagNameExists($name)
{
	//Doe een count op alle tags met dezelfde naam in de database
	$result = Fetch("select count(*) from tag where name=?", array($name), "s");
	//Haal de count op uit de resultset
	$count = $result[0][0];
	//Groter? bestaat kleiner of gelijk aan? bestaat nog niet
	if ($count > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function AddTagToDatabase($name, $description)
{
	//Insert tag in database
	Execute("insert into tag values (null, ?, ?)", array($name, $description), "ss");
}

function GetTagById($tagId)
{
	//Haal alle tags op uit de database waar de id gelijk is
	$result = Fetch("select * from tag where tagid=?", array($tagId), "i");
	//Geen resultaten? geef false terug
	if ($result == 0)
	{
		return false;
	}
	else
	{
		//Haal eerste tag op uit resultset
		$row = $result[0];
		//Creëer nieuw object
		$tag = new Tag();
		//Wijs object variabelen toe
		$tag->tagId = $row[0];
		$tag->name = $row[1];
		$tag->description = $row[2];
		//Geef tag terug
		return $tag;
	}
}

function RemoveTagFromDatabase($tagId)
{
	Execute("delete from tag where tagid=?", array($tagId), "i");
}



class User
{
	public $userId;
	public $userTypeId;
	public $name;
	public $email;
	public $password;
	public $admin;
}



function GetUserById($userId)
{
	//Haal users op uit database
	$result = Fetch("select * from user where userid = ?", array($userId), "i");
	//Pak user uit users array
	$userRow = $result[0];
	//Creëer nieuw user object
	$user = new User();
	//Wijs waardes toe aan user object
	$user->userId = $userRow[0];
	$user->userTypeId = $userRow[1];
	$user->name = $userRow[2];
	$user->email = $userRow[3];
	$user->password = $userRow[4];
	$user->admin = $userRow[5];
	//Geef user object terug aan functie caller
	return $user;
}



function ApproveVideo($userId, $videoId)
{
	$user = GetUserById($userId);
	if (!$user->admin)
	{
		return false;
	}
	
	$video = GetVideoById($videoId);
	$video->approved = true;
	$video->releaseDate = time();
	
	UpdateVideoInDatabase($video);
}



function CreateVideo($userId, $title, $description, $video, $thumbnail)
{
	//Haal de gebruiker op uit de database
	$user = GetUserById($userId);
	//Sla de video op en haal unieke sleutel op
	$urlId = AddVideoToFileSystem($video);	
	//Sla de thumbnail op en haal unieke sleutel op
	$response = AddThumbnailToFileSystem($thumbnail);
	//Kijk of de thumbnail goed is opgeslagen op het filsystem
	if (!$response)
	{
		echo "Something went wrong uploading your video.";
		return;
	}
	//Maak een nieuw video object
	$video = new Video();
	//Wijs waardes toe aan video object
	$video->uploader = $user->userId;
	$video->title = $title;
	$video->description = $description;
	$video->approved = false;
	$video->urlId = $urlId;
	$video->thumbnailId = $response->thumbnailUrlId;	
	$video->thumbnailExtension = $response->extension;
	//Voeg het object toe aan de database
	AddVideoToDatabase($video);
}



function GetVideo($videoId)
{
	//Haal video op
	$video = GetVideoById($videoId);
	//Haal gebruiker op
	$user = GetUserById($video->uploader);
	//Haal alle beoordelingen van de video
	$ratings = GetRatingsByVideoId($video->videoId);
	//Bereken de gemiddelde score van de beoordelingen
	$averageRating = GetAverageRating($ratings);
	//Haal de thumbnail en de video url op
	$thumbnailUrl = GetThumbnailUrl($video->thumbnailId, $video->thumbnailExtension);
	$videoUrl = GetVideoUrl($video->urlId);		
	//Creëer een nieuw object met alle benodigde attributen voor het laten zien van de video
	$videoResult = new GetVideoResult();
	$videoResult->videoId = $video->videoId;
	$videoResult->title = $video->title;
	$videoResult->description = $video->description;
	$videoResult->videoUrl = $videoUrl;
	$videoResult->thumbnailUrl = $thumbnailUrl;
	$videoResult->rating = $averageRating;
	$videoResult->uploader = $user->userId;
	$videoResult->uploaderName = $user->name;
	//Geef het gecreëerde object terug
	return $videoResult;
}

function GetAverageRating($ratings)
{
	if (empty($ratings))
	{
		return 0;
	}
	//Bereken de gemiddelde score van de beoordelingen
	$ratingNumbers = array();
	foreach ($ratings as $rating)
	{
		$ratingNumbers[] = $rating->rating;
	}
	return (array_sum($ratingNumbers) / count($ratingNumbers));
}
	


function GetVideosByTag($tagId)
{
	//Haal videotags op
	$videotags = GetVideoTagsByTag($tagId);
	//Creëer video array
	$videos = array();
	//Lus door gevonden videotags heen
	foreach ($videotags as $videotag)
	{
		//Verwijs de videos aan de array
		$videos[] = GetVideoById($videotag->videoId);
	}
	//Geef array terug
	return $videos;
}



function RemoveVideo($videoId, $userId)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of user een admin is of userid gelijk is aan de uploader
	if (!$user->admin || $video->uploader != $userId)
	{
		return false;
	}
	//Verwijder tabel relaties
	RemoveRatingsByVideo($videoId);
	RemovePlaylistVideos($videoId);
	RemoveVideoTags($videoId);
	//Verwijder video inhoud van het file systeem
	RemoveVideoFromFileSystem($video->urlId);
	RemoveThumbnailFromFileSystem($video->thumbnailId, $video->thumbnailExtension);
	//Verwijder video
	RemoveVideoFromDatabase($videoId);
}



function UpdateVideo($videoId, $userId, $title = null, $description = null, $thumbnail = null)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of de user rechten heeft om de video te updaten
	if(!$user->admin || $video->uploader != $userId)
	{
		return false;
	}
	if ($title != null)
	{
		//Wijs nieuwe title toe aan video
		$video->title = $title;
	}
	if ($description != null)
	{
		//Wijs nieuwe beschrijving toe aan video
		$video->description = $description;
	}
	if ($thumbnail != null)
	{
		//Voeg aller eerst de nieuwe thumbnail toe
		$response = AddThumbnailToFileSystem($thumbnail);
		//Verwijder dan de oude van het file systeem
		RemoveThumbnailFromFileSystem($video->thumbnailId, $video->thumbnailExtension);
		//Wijs nieuwe thumbnail waardes toe aan video
		$video->thumbnailId = $response->thumbnailUrlId;
		$video->thumbnailExtension = $response->extension;
	}
	//Update de video in de database
	UpdateVideoInDatabase($video);
}



class GetVideoResult
{
	public $videoId;
	public $title;
	public $description;
	public $videoUrl;
	public $thumbnailUrl;
	public $rating;
	public $uploader;
	public $uploaderName;
}



class Video
{
	public $videoId;
	public $uploader;
	public $title;
	public $releaseDate;
	public $description;
	public $approved;
	public $urlId;
	public $thumbnailId;
	public $thumbnailExtension;
}



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
	$video->uploader = $row[1];
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

function UpdateVideoInDatabase($video)
{
	$query = "update video set title=?, description=?, approved=?, thumbnail=?, thumbnailextension=? where videoid=?";
	
	$params = array(
		$video->title,
		$video->description,
		$video->approved,
		$video->thumbnailId,
		$video->thumbnailExtension,
		$video->videoId
	);
	
	Execute($query, $params, "ssissi");
}



function AddVideoToFileSystem($video)
{
	//Pad naar videos
	$videoPath = getcwd() . "/videos/";
	//Genereer nieuwe guid voor video
	$videoFileSystemId = GenerateGuid();
	//Verplaats video van tijdelijk naar permanente opslag
	move_uploaded_file($video["tmp_name"], $videoPath . $videoFileSystemId . ".mp4");
	//Geef sleutel van video terug
	return $videoFileSystemId;
}

function AddThumbnailToFileSystem($thumbnail)
{
	//Bepaal extensie van afbeelding
	$extension = "";
	switch ($thumbnail["type"])
	{
		case "image/gif":
			$extension = "gif";
			break;
		case "image/jpeg":
			$extension = "jpg";
			break;
		case "image/jpg":
			$extension = "jpg";
			break;
		case "image/png":
			$extension = "png";
			break;
	}
	//Geef false terug wanneer extensie niet is gevonden
	if (empty($extension))
	{
		return false;
	}
	//Pad naar thumbnails
	$thumbnailPath = getcwd() . "/imgs/thumbnails/";
	//Genereer nieuwe guid voor thumbnail
	$thumbnailUrlId = GenerateGuid();
	//Verplaats thumbnail van tijdelijk naar permanente opslag
	move_uploaded_file($thumbnail["tmp_name"], $thumbnailPath . $thumbnailUrlId . "." . $extension);
	//Geef sleutel en extension van de thumbnail terug
	$response = new AddThumbnailToFileSystemResponse();
	$response->thumbnailUrlId = $thumbnailUrlId;
	$response->extension = $extension;
	return $response;
}

class AddThumbnailToFileSystemResponse
{
	//File systeem id van de thumbnail
	public $thumbnailUrlId;
	//Extentie van de thumbnail
	public $extension;
}

function GetVideoUrl($videoUrlId)
{
	//Url naar specifieke video
	return "localhost/UnderStending/videos/{$videoUrlId}.mp4";
}

function GetThumbnailUrl($thumbnailUrlId, $extension)
{
	//Url naar specifieke thumbnail
	return "localhost/UnderStending/imgs/thumbnails/{$thumbnailUrlId}.{$extension}";
}

function RemoveThumbnailFromFileSystem($thumbnailUrlId, $extension)
{
	//Pad naar thumbnails
	$thumbnailPath = getcwd() . "/imgs/thumbnails/";
	//Verwijder thumbnail uit het file systeem
	unlink("{$thumbnailPath}{$thumbnailUrlId}.{$extension}");
}

function RemoveVideoFromFileSystem($videoUrlId)
{
	//Pad naar videos
	$videoPath = getcwd() . "/videos/";
	//Verwijder video uit het file systeem
	unlink("{$videoPath}{$videoUrlId}.mp4");
}



function AddVideoTag($userId, $videoId, $tagId)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of user recht heeft om videotags te creëren
	if ($video->uploader != $userId || !$user->admin)
	{
		return false;
	}
	//Haal tag op
	$tag = GetTagById($tagId);
	//Voeg videotag toe
	AddVideoTagToDatabase($videoId, $tagId);
}



function RemoveVideoTag($userId, $videoId, $tagId)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Verwijder videotag
	RemoveVideoTagFromDatabase($videoId, $tagId);
}



class VideoTag
{
	public $videoId;
	public $tagId;
}



function AddVideoTagToDatabase($videoId, $tagId)
{
	Execute("insert into videotag values (?, ?)", array($videoId, $tagId), "ii");
}

function RemoveVideoTags($videoId)
{
	Execute("delete from videotag where videoid=?", array($videoId), "i");
}

function GetVideoTagsByTag($tagId)
{
	//Haal videotags op o.b.v tagid
	$result = Fetch("select * from videotag where tagid=?", array($tagId), "i");
	//Creëer nieuw videotag array
	$videotags = array();
	//Lus door alle rows heen die zijn gevonden uit de database
	foreach ($result as $row)
	{
		$videotag = new VideoTag();
		$videotag->videoId = $row[0];
		$videotag->tagId = $row[1];
		$videotags[] = $videotag;
	}
	//Geef gecreëerde videotag array terug
	return $videotags;
}

function RemoveVideoTagsByTag($tagId)
{
	Execute("delete from videotag where tagid=?", array($tagId), "i");
}

function RemoveVideoTagFromDatabase($videoId, $tagId)
{
	Execute("delete from videotag where videoid=? and tagid=?", array($videoId, $tagId), "ii");
}

?>