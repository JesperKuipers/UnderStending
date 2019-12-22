<?php

function RemoveVideo($videoId)
{
	RemoveRatingsByVideo($videoId);
	RemovePlaylistVideos($videoId);
	RemoveVideoTags($videoId);
	RemoveVideoFromDatabase($videoId);
}

?>