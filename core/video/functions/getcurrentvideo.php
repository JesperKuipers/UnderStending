<?php

function GetCurrentVideo($userId)
{
	$user = GetUserById($userId);
	if (!$user)
	{
		return false;
	}
	
	$currentlyWatchings = GetCurrentlyWatchingsByUser($userId);
	if (count($currentlyWatchings) > 0)
	{
		//Haal eerste currentlywatching op
		$currentlyWatching = $currentlyWatchings[0];
		//Haal videoid uit currentlywatching
		$videoId = $currentlyWatching->videoId;
		//Haal getVideoResult op
		$getVideoResult = GetVideo($videoId);
		//Creëer nieuw getCurrentVideoResult object en geef getVideoResult mee
		$getCurrentVideoResult = new GetCurrentVideoResult($getVideoResult);
		//Wijs timestamp toe aan getCurrentVideoResult
		$getCurrentVideoResult->timestamp = $currentlyWatching->timestamp;
		//Geef getcurrentVideoResult terug
		return $getCurrentVideoResult;
	}
	else
	{
		return false;
	}
}

?>