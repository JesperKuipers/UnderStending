<?php

function ApproveVideo($userId, $videoId)
{
	$user = GetUserById($userId);
	if (!$user->admin)
	{
		return false;
	}
	
	$video = GetVideoById($videoId);
	$video->approved = true;
	$video->releaseDate = date("yy-m-d");
	
	UpdateVideoInDatabase($video);
}

?>