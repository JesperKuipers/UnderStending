<?php

function RemoveVideo($videoId, $userId)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of user een admin is of userid gelijk is aan de uploader
	if (!$user->admin || $video->uploader != $userId)
	{
		return false;
	}
	//Verwijder tabel relaties
	RemoveRatingsByVideo($videoId);
	RemovePlaylistVideos($videoId);
	RemoveVideoTagsByVideoId($videoId);
	RemoveCurrentlyWatchingsByVideoId($videoId);
	//Verwijder video inhoud van het file systeem
	RemoveVideoFromFileSystem($video->urlId);
	RemoveThumbnailFromFileSystem($video->thumbnailId, $video->thumbnailExtension);
	//Verwijder video
	RemoveVideoFromDatabase($videoId);
	//Verwijder alle tags zonder koppeling
	CleanTags();
}

?>