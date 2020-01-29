<?php

function GetVideosByPlaylist($playlistId)
{
	//haal playlistvideo op
	$playlistVideos = GetPlaylistVideosByPlaylistId($playlistId);
	//creëer video's array
	$videos = array();
	//lus door de playlistvideo's heen
	foreach ($playlistVideos as $playlistVideo)
	{
		//haal video op op basis van playlistvideo
		$video = GetVideo($playlistVideo->videoId);
		//Kijk of de video geen false teruggeeft en of de video is goedgekeurd
		if ($video && $video->approved)
		{
			//voeg video toe aan video's array
			$videos[] = $video;
		}
	}
	//geef video's array terug
	return $videos;
}

?>