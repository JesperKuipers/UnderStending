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

function RemoveVideoTagsFromDatabase($videoId, $tagIds)
{
	if (empty($tagIds))
	{
		return;
	}
	//query om alle videotags te verwijderen die zich niet in de tagids bevinden
	$query = "delete from videotag where videoid=? and tagid not in (?)";
	$tagsAsString = "'" . implode("', '", $tagIds) . "'";
	return Execute($query, array($videoId, $tagsAsString), "is");
}

function AddVideoTagsToDatabase($videoTags)
{
	//Lus door de tags heen
	foreach ($videoTags as $videoTag)
	{
		//query om te kijken of er al een videotag bestaat met de videoid en tagid
		$existsQuery = "select count(*) from videotag where videoid=? and tagid=?";
		//Haal resultaat op
		$tagCount = Fetch($existsQuery, array($videoTag->videoId, $videoTag->tagId), "ii")[0][0];
		//Kijk of de tag al bestaat met videoid en tagid
		if ($tagCount == 0)
		{
			//query om de videotag in te voegen
			$insertQuery = "insert into videotag values (?, ?)";
			//voer insert uit
			Execute($insertQuery, array($videoTag->videoId, $videoTag->tagId), "ii");
		}
	}
}

?>