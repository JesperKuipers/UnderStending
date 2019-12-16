<?php

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

?>