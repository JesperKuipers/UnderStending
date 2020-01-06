<?php

function GetVideos($index, $limit)
{
	$videos = GetVideosFromDatabase($index, $limit);
	if (!$videos)
	{
		return false;
	}
	else
	{
		return $videos;
	}
}

?>