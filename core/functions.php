<?php

//Geeft terug: boolean (0 = failed, 1 = success)
function Insert($query, $params, $types)
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
function Select($query, $params, $types)
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
	$result = Select("select * from user where userid = ?", array($userId), "i");
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



function CreateVideo($userId, $title, $description, $video, $thumbnail)
{
	//Haal de gebruiker op uit de database
	$user = GetUserById($userId);
	//Sla de video op en haal unieke sleutel op
	$urlId = AddVideoToFileSystem($video);	
	//Sla de thumbnail op en haal unieke sleutel op
	$thumbnailId = AddThumbnailToFileSystem($thumbnail);	
	//Maak een nieuw video object
	$video = new Video();
	//Wijs waardes toe aan video object
	$video->userId = $user->userId;
	$video->title = $title;
	$video->description = $description;
	$video->approved = false;
	$video->urlId = $urlId;
	$video->thumbnailId = $thumbnailId;	
	//Voeg het object toe aan de database
	AddVideoToDatabase($video);
}



class Video
{
	public $videoId;
	public $userId;
	public $title;
	public $releaseDate;
	public $description;
	public $approved;
	public $urlId;
	public $thumbnailId;
}



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



function AddVideoToFileSystem($video)
{
	//Pad naar videos
	$videoPath = getcwd() . "/../videos/";
	//Genereer nieuwe guid voor video
	$videoFileSystemId = GenerateGuid();
	//Verplaats video van tijdelijk naar permantente opslag
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
			$extension = ".gif";
			break;
		case "image/jpeg":
			$extension = ".jpg";
			break;
		case "image/jpg":
			$extension = ".jpg";
			break;
		case "image/png":
			$extension = ".png";
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
	$thumbnailFileSystemId = GenerateGuid();
	//Verplaats thumbnail van tijdelijk naar permantente opslag
	move_uploaded_file($thumbnail["tmp_name"], $thumbnailPath . $thumbnailFileSystemId . $extension);
	//Geef sleutel van thumbnail terug
	return $thumbnailFileSystemId;
}

?>