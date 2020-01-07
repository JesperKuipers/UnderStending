<?php

function GetVideos($index, $limit)
{
	$videos = GetVideosFromDatabase($index, $limit);
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