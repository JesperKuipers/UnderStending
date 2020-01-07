<?php

function GetVideos($limit)
{
	$videos = GetVideosFromDatabase($limit);
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