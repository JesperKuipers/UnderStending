<?php

function CreateAndAddTagsToVideo($userId, $videoId, $names)
{
	$video = GetVideoById($videoId);
	//Kijk of video bestaat
	if ($video)
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
			//Kijk of videotag nog niet bestaat
			if (!VideoTagExists($videoId, $tagId))
			{
				//Voeg videotags o.b.v van de tag id
				AddVideoTag($userId, $videoId, $tagId);
			}
		}
		//Geef tagIds terug
		return $tagIds;
	}
	else
	{
		return false;
	}
}

?>