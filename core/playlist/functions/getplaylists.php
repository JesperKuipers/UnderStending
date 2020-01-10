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
		return $playlists;
	}
}

?>