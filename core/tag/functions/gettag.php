<?php

function GetTag($tagId)
{
	//Haal tag op
	$tag = GetTagById($tagId);
	//Haal videoTags op o.b.v tag
	$videoTags = GetVideoTagsByTag($tagId, 1);
	//Geef false terug wanneer tag niet bestaad
	if (!$tag)
	{
		return false;
	}
	else
	{
		//Creëer nieuwe getTagResult
		$getTagResult = new GetTagResult();
		//Zet properties
		$getTagResult->tagId = $tag->tagId;
		$getTagResult->name = $tag->name;
		//Wijs een thumbnailUrl toe aan de tag wanneer de videotags niet leeg zijn
		if (empty($videoTags))
		{
			$getTagResult->thumbnailUrl = false;
		}
		else
		{
			$video = GetVideoById($videoTags[0]->videoId);
			$getTagResult->thumbnailUrl = $video->thumbnailUrl();
		}
		//Geef getTagResult terug
		return $getTagResult;
	}
}

?>