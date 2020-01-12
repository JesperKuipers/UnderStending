<?php

function GetTag($tagId)
{
	$tag = GetTagById($tagId);
	$videoTags = GetVideoTagsByTag($tagId, 1);
	if (!$tag)
	{
		return false;
	}
	else
	{
		$getTagResult = new GetTagResult();
		$getTagResult->tagId = $tag->tagId;
		$getTagResult->name = $tag->name;
		//Wijs een thumbnailUrl toe aan de tag wanneer de videotags niet leeg zijn
		if (empty($videoTags))
		{
			$getTagResult->thumbnailUrl = false;
		}
		else
		{
			$video = GetVideo($videoTags[0]->videoId);
			$getTagResult->thumbnailUrl = $video->thumbnailUrl;
		}
		return $getTagResult;
	}
}

?>