<?php

function GetVideosByTag($tagId, $limit)
{
	//Haal videotags op
	$videotags = GetVideoTagsByTag($tagId, $limit);
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