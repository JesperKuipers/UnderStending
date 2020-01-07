<?php

function GetVideos($limit)
{
	$videos = GetVideosFromDatabase($limit);
	if (!$videos)
	{
		return array();
	}
	else
	{
		return $videos;
	}
}

?>