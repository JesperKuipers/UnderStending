<?php

function UpdateVideo($videoId, $title = null, $description = null, $thumbnail = null)
{
	//Get that needs to be updated
	$video = GetVideoById($videoId);	
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

?>