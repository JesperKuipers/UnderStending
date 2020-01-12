<?php

function RemovePlaylistVideos($videoId)
{
	Execute("delete from playlistvideo where videoid=?", array($videoId), "i");
}

function GetPlaylistVideosByPlaylistId($playlistId)
{
	$result = Fetch("select * from playlistvideo where playlistid=?", array($playlistId), "i");
	$playlistVideos = array();
	foreach ($result as $row)
	{
		$playlistVideo = new PlaylistVideo();
		$playlistVideo->videoId = $row[0];
		$playlistVideo->playlistId = $row[1];
		$playlistVideos[] = $playlistVideo;
	}
	return $playlistVideos;
}

?>