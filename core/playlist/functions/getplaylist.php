<?php

function GetPlaylist($playlistId)
{
	$playlist = GetPlaylistById($playlistId);
	if (!$playlist)
	{
		return false;
	}
	else
	{
		return $playlist;
	}
}

?>