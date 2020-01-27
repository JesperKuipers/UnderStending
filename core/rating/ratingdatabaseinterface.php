<?php

function AddRatingToDatabase($tag)
{
	//Creëer query
	$statement = "insert into rating values (?, ?, ?)";	
	//Creëer query parameters
	$parameters = array(
		$tag->videoId,
		$tag->userId,
		$tag->rating,
	);
	//Voeg tag toe aan database
	if (Execute($statement, $parameters, "iii"))
	{
		$tagId = Fetch("select max(tagid) from rating")[0][0];
	}
	else
	{
		return false;
	}
}

function RemoveRatingsByVideo($videoId)
{
	Execute("delete from rating where videoid=?", array($videoId), "i");
}

?>