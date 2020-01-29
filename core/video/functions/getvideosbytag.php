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
		$video = GetVideoById($videotag->videoId);
		//Kijk of de video geen false teruggeeft en of de video is goedgekeurd
		if ($video && $video->approved)
		{
			//Verwijs de videos aan de array
			$videos[] = $video;
		}		
	}
	//Geef array terug
	return $videos;
}

?>