<?php

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

?>