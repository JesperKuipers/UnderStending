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
		$currentlyWatching = $currentlyWatchings[0];
		$videoId = $currentlyWatching->videoId;
		return GetVideo($videoId);
	}
	else
	{
		return false;
	}
}

?>