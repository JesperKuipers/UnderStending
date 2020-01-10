<?php

function CreatePlaylist($userId, $name)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of gebruiker wel bestaat
	if (!$user)
	{
		return false;
	}
	//Creër playlist object
	$playlist = new Playlist();
	$playlist->userId = $user->userId;
	$playlist->name = $name;
	//Voeg playlist toe aan database
	$playlistId = AddPlaylistToDatabase($playlist);
	//Geef gecreërde playlistid terug
	return $playlistId;
}

?>