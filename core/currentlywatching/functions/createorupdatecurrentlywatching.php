<?php

function CreateOrUpdateCurrentlyWatching($videoId, $userId, $timestamp, $finished)
{
	$user = GetUserById($userId);
	if (!$user)
	{
		return "De gebruiker is niet gevonden.";
	}
	
	$video = GetVideoById($videoId);
	if (!$video)
	{
		return "De video is niet gevonden.";
	}
	
	$currentlyWatching = new CurrentlyWatching();
	$currentlyWatching->videoId = $videoId;
	$currentlyWatching->userId = $userId;
	$currentlyWatching->timestamp = $timestamp;
	$currentlyWatching->finished = $finished;
	
	if (CurrentlyWatchingExists($videoId, $userId))
	{
		UpdateCurrentlyWatchingInDatabase($currentlyWatching);
	}
	else
	{
		AddCurrentlyWatchingToDatabase($currentlyWatching);
	}
}

?>