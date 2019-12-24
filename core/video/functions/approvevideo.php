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
	$video->releaseDate = time();
	
	UpdateVideoInDatabase($video);
}

?>