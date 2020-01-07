<?php

function GetTagsByVideo($videoId)
{
	$videoTags = GetVideoTagsByVideo($videoId);
	$tags = array();
	foreach ($videoTags as $videoTag)
	{
		$tags[] = GetTag($videoTag->tagId);
	}
	return $tags;
}

?>