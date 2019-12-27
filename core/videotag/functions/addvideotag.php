<?php

function AddVideoTag($userId, $videoId, $tagId)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of user recht heeft om videotags te creëren
	if ($video->uploader != $userId || !$user->admin)
	{
		return false;
	}
	//Haal tag op
	$tag = GetTagById($tagId);
	//Voeg videotag toe
	AddVideoTagToDatabase($videoId, $tagId);
}

?>