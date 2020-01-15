<?php

function GetNonApprovedVideos($index, $limit)
{
	$videos = GetNonApprovedVideosFromDatabase($index, $limit);
	if ($videos)
	{
		return $videos;
	}
	else
	{
		return array();
	}
}

?>