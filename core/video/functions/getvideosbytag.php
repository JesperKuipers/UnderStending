<?php

function GetVideosByTag($tagId)
{
	//Haal videotags op
	$videotags = GetVideoTagsByTag($tagId);
	//Creëer video array
	$videos = array();
	//Lus door gevonden videotags heen
	foreach ($videotags as $videotag)
	{
		//Verwijs de videos aan de array
		$videos[] = GetVideoById($videotag->videoId);
	}
	//Geef array terug
	return $videos;
}

?>