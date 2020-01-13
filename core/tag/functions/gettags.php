<?php

function GetTags($index, $limit)
{
	//haal tags op uit database
	$tags = GetTagsFromDatabase($index, $limit);
	//creëer tagswiththumbnail array
	$tagsWithThumbnails = array();
	//Geef lege array terug wanneer tags niet bestaan
	if (!$tags)
	{
		return array();
	}
	else
	{
		//Lus door de tags heen
		foreach ($tags as $tag)
		{
			//Haal tag op met de eerste video thumbnail
			$tagWithThumbnails[] = GetTag($tag->tagId);			
		}
		//Geef tags terug met thumbnail
		return $tagsWithThumbnails;
	}
}

?>