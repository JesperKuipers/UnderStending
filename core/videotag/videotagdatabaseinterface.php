<?php

function AddVideoTagToDatabase($videoId, $tagId)
{
	Execute("insert into videotag values (?, ?)", array($videoId, $tagId), "ii");
}

function RemoveVideoTags($videoId)
{
	Execute("delete from videotag where videoid=?", array($videoId), "i");
}

function GetVideoTagsByTag($tagId)
{
	//Haal videotags op o.b.v tagid
	$result = Fetch("select * from videotag where tagid=?", array($tagId), "i");
	//Creëer nieuw videotag array
	$videotags = array();
	//Lus door alle rows heen die zijn gevonden uit de database
	foreach ($result as $row)
	{
		$videotag = new VideoTag();
		$videotag->videoId = $row[0];
		$videotag->tagId = $row[1];
		$videotags[] = $videotag;
	}
	//Geef gecreëerde videotag array terug
	return $videotags;
}

function GetVideoTagsByVideoId($videoId)
{
	//Haal videotags op o.b.v videoId
	$result = Fetch("select * from videotag where videoid=?", array($videoId), "i");
	//Creëer nieuw videotag array
	$videotags = array();
	//Lus door alle rows heen die zijn gevonden uit de database
	foreach ($result as $row)
	{
		$videotag = new VideoTag();
		$videotag->videoId = $row[0];
		$videotag->tagId = $row[1];
		$videotags[] = $videotag;
	}
	//Geef gecreëerde videotag array terug
	return $videotags;
}

function RemoveVideoTagsByTag($tagId)
{
	Execute("delete from videotag where tagid=?", array($tagId), "i");
}

function RemoveVideoTagFromDatabase($videoId, $tagId)
{
	Execute("delete from videotag where videoid=? and tagid=?", array($videoId, $tagId), "ii");
}

?>