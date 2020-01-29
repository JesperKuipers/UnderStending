<?php 

function UpdatePlaylist($playlistId, $name)
{
	$playlist = GetPlaylistById($playlistId);
	$playlist->name = $name;
	UpdatePlaylistInDatabase($playlist);
}