<?php

function UpdateTagsFromVideo($userId, $videoId, $names)
{
	//Voeg nog niet bestaande tags toe en geef tagIds terug
	$tagIds = CreateAndAddTagsToVideo($userId, $videoId, $names);
	//Verwijder alle koppelingen tussen tags en videos die zich niet in de tagIds bevinden
	RemoveVideoTagsByVideoAndTagIds($videoId, $tagIds);
	//Verwijder alle tags zonder koppeling met een video
	CleanTags();
	//Geef tagIds terug
	return $tagIds;
}

?>