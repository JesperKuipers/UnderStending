<?php

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

?>