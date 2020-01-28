<?php

function AddVideoTagToDatabase($videoId, $tagId)
{
	return Execute("insert into videotag values (?, ?)", array($videoId, $tagId), "ii");
}

function RemoveVideoTagsByVideoId($videoId)
{
	return Execute("delete from videotag where videoid=?", array($videoId), "i");
}

function GetVideoTagsByTag($tagId, $limit)
{
	//Haal videotags op o.b.v tagid
	$result = Fetch("select * from videotag where tagid=? limit ?", array($tagId, $limit), "ii");
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
	return Execute("delete from videotag where tagid=?", array($tagId), "i");
}

function RemoveVideoTagFromDatabase($videoId, $tagId)
{
	return Execute("delete from videotag where videoid=? and tagid=?", array($videoId, $tagId), "ii");
}

function VideoTagExists($videoId, $tagId)
{
	//query om te kijken of er al een videotag bestaat met de videoid en tagid
	$query = "select count(*) from videotag where videoid=? and tagid=?";
	//Haal resultaat op
	$result = Fetch($query, array($videoId, $tagId), "ii");
	//Kijk of videotags bestaan met meegegeven waardes
	$exists = $result[0][0] > 0;
	//Geef conditie terug
	return $exists;
}

function RemoveVideoTagsByVideoAndTagIds($videoId, $tagIds)
{
	//Verwijder alle videotags van 
	if (empty($tagIds))
	{
		return RemoveVideoTagsByVideo($videoId);
	}
	//Haal vraagtekens op voor tagids
	$questMarksForTagIds = ImplodeItemByCount(", ", "?", count($tagIds));
	//query om alle videotags te verwijderen die zich niet in de tagids bevinden
	$query = "delete from videotag where videoid=? and tagid not in (".$questMarksForTagIds.")";
	//Creëer paramater array met videoId
	$params = array($videoId);
	//Lus door tagids heen en voeg ze toe aan parameters
	foreach ($tagIds as $tagId)
	{
		$params[] = $tagId;
	}
	//Haal int types op voor array (sinds alle array items van het type integer zijn kan dit)
	$paramTypes = ImplodeItemByCount("", "i", count($params));
	//Voer de query uit
	return Execute($query, $params, $paramTypes);
}

function RemoveVideoTagsByVideo($videoId)
{
	return Execute("delete from videotag where videoid=?", array($videoId), "i");
}

?>