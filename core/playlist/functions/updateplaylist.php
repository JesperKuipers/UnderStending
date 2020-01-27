<?php

function UpdatePlaylist($playlistId, $name)
{
	$playlist = GetPlaylistById($playlistId);
	if ($playlist)
	{
		$playlist->name = $name;
		UpdatePlaylistInDatabase($playlist);
	}
	else
	{
		return false;
	}
}

?>