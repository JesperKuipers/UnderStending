<?php

function UpdateTagsFromVideo($videoId, $tagIds)
{
	//Verwijder alle koppelingen tussen tags en videos die zich niet in de tag array bevinden
	RemoveVideoTagsFromDatabase($videoId, $tagIds);
	//creëer een lijst voor toe te voegen videotags
	$videoTags = array();
	//lus door tagIds heen en maak er een videotag van
	foreach ($tagIds as $tagId)
	{
		$videoTag = new VideoTag();
		$videoTag->videoId = $videoId;
		$videoTag->tagId = $tagId;
		$videoTags[] = $videoTag;
	}
	//Voeg alle koppeling tussen tags en videos toe die zich in de tag array bevinden maar nog niet in de database
	AddVideoTagsToDatabase($videoTags);
}

?>