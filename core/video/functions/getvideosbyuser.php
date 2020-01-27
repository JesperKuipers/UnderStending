<?php

function GetVideosByUser($userId)
{
	$videos = GetVideosByUserFromDatabase($userId);
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