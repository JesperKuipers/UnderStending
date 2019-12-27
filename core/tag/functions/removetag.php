<?php

function RemoveTag($userId, $tagId)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Verwijder videotags afhankelijk van de te verwijderen tag
	RemoveVideoTagsByTag($tagId);
	//Verwijder tag
	RemoveTagFromDatabase($tagId);
}

?>