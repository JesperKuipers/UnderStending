<?php

function AddVideoTag($userId, $videoId, $tagId)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of user recht heeft om videotags te creëren
	if ($video->uploader != $userId && !$user->admin)
	{
		return false;
	}
	//Voeg videotag toe
	return AddVideoTagToDatabase($videoId, $tagId);
}

?>