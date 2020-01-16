<?php

function GetPlaylists($index, $limit)
{
	$playlists = GetPlaylistsFromDatabase($index, $limit);
	if (!$playlists)
	{
		return false;
	}
	else
	{
		$playlistsWithThumbnail = array();
		foreach ($playlists as $playlist)
		{
			$playlistsWithThumbnail[] = GetPlaylist($playlist->playlistId);
		}
		return $playlistsWithThumbnail;
	}
}

?>