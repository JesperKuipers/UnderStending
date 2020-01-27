<?php

function GetPlaylist($playlistId)
{
	//Haal playlist op
	$playlist = GetPlaylistById($playlistId);
	//Haal playlistvideos op o.b.v playlist
	$playlistVideos = GetPlaylistVideosByPlaylist($playlistId);
	//Kijk of playlist daadwerkelijk is opgehaald
	if ($playlist)
	{
		//Creëer nieuwe getplaylistresult
		$getPlaylistResult = new GetPlaylistResult();
		//Wijs properties toe
		$getPlaylistResult->playlistId = $playlist->playlistId;
		$getPlaylistResult->userId = $playlist->userId;
		$getPlaylistResult->name = $playlist->name;
		//Wijs thumbnailurl toe wanneer playlistvideos aanwezig zijn
		if (empty($playlistVideos))
		{
			$getPlaylistResult->thumbnailUrl = false;
		}
		else
		{
			$video = GetVideo($playlistVideos[0]->videoId);
			$getPlaylistResult->thumbnailUrl = $video->thumbnailUrl;
		}
		//Geef getplaylistresult object terug
		return $getPlaylistResult;
	}
	else
	{
		return false;
	}
}

?>