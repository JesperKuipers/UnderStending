<?php

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