<?php

function RemoveVideo($videoId)
{
	//Verwijder tabel relaties
	RemoveRatingsByVideo($videoId);
	RemovePlaylistVideos($videoId);
	RemoveVideoTags($videoId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Verwijder video inhoud van het file systeem
	RemoveVideoFromFileSystem($video->urlId);
	RemoveThumbnailFromFileSystem($video->thumbnailId, $video->thumbnailExtension);
	//Verwijder video
	RemoveVideoFromDatabase($videoId);
}

?>