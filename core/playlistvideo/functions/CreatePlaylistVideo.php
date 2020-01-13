<?php

function CreatePlaylistVideo($playlistId, $videoId)
{
	//haal playlist op
	$playlist = GetPlaylistById($playlistId);
	//geef false terug wanneer playlist niet is gevonden
	if (!$playlist)
	{
		return false;
	}
	//haal video op
	$video = GetVideoById($videoId);
	//geef false terug wanneer video niet gevonden
	if (!$video)
	{
		return false;
	}
	//creëer nieuw playlistvideo object
	$playlistVideo = new PlaylistVideo();
	//wijs properties toe
	$playlistVideo->videoId = $videoId;
	$playlistVideo->playlistId = $playlistId;
	//voeg playlistvideo toe aan de database
	return AddPlaylistVideoToDatabase($playlistVideo);
}

?>