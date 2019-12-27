<?php

function RemoveVideoTag($userId, $videoId, $tagId)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Verwijder videotag
	RemoveVideoTagFromDatabase($videoId, $tagId);
}

?>