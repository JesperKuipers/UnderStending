<?php 

function EditPlaylist($EditPlaylistId, $Name)
{
	$Playlist = GetPlaylistById($EditPlaylistId);
	$Playlist->name = $Name;
	UpdatePlaylist($Playlist);
}