<?php

function CreateAndAddTagsToVideo($userId, $videoId, $names)
{
	$tagIds = array();
	//Loop door alle te creëren tags heen
	foreach ($names as $name)
	{
		//Creër tags
		$tagId = CreateTag($userId, $name);
		//Tag bestaat al?
		if (!$tagId)
		{
			//Haal tag op o.b.v naam
			$tagId = GetTagIdByName($name);
		}
		$tagIds[] = $tagId;
	}
	
	//Loop door alle tagIds heen
	foreach ($tagIds as $tagId)
	{
		//Voeg videotags o.b.v van de gecreërde tag
		AddVideoTag($userId, $videoId, $tagId);
	}
}

?>