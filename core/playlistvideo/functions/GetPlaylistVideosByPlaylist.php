<?php

function GetPlaylistVideosByPlaylist($playlistId)
{
	$playlistVideos = GetPlaylistVideosByPlaylistId($playlistId);
	if ($playlistVideos)
	{
		return $playlistVideos;
	}
	else
	{
		return array();
	}
}

?>