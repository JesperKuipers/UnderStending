<?php

function GetVideoTagsByVideo($videoId)
{
	$videoTags = GetVideoTagsByVideoId($videoId);
	if (!$videoTags)
	{
		return array();
	}
	else
	{
		return $videoTags;
	}
}

?>