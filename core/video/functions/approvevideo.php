<?php

function ApproveVideo($userId, $videoId)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of de gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Haal video op
	$video = GetVideoById($videoId);
	//Update relevante video properties
	$video->approved = true;
	$video->releaseDate = date("yy-m-d");
	//Update video
	if (UpdateVideoInDatabase($video))
	{
		//Notificeer de gebruiker van de goedgekeurde video
		return NotifyApprovedVideo($videoId);
	}
	else
	{
		return false;
	}
}

?>