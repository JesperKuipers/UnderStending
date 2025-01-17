<?php

function UpdateVideo($videoId, $userId, $title = null, $description = null, $thumbnail = null)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of de user rechten heeft om de video te updaten
	if($user->admin || $video->uploader == $userId)
	{
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
	else
	{
		return false;
	}
}

?>