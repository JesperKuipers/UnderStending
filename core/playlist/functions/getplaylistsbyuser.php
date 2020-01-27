<?php

function GetPlaylistsByUser($userId)
{
	$playlists = GetPlaylistsByUserFromDatabase($userId);
	if ($playlists)
	{
		return $playlists;
	}
	else
	{
		return array();
	}
}

?>