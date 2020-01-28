<?php

function AddCurrentlyWatchingToDatabase($currentlyWatching)
{
	$query = "insert into currentlywatching values (?, ?, ?, ?)";
	
	$parameters = array(
		$currentlyWatching->videoId,
		$currentlyWatching->userId,
		$currentlyWatching->timestamp,
		$currentlyWatching->finished
	);
	
	return Execute($query, $parameters, "iidi");
}

function CurrentlyWatchingExists($videoId, $userId)
{
	$query = "select count(*) from currentlywatching where videoid=? and userid=?";
	$result = Fetch($query, array($videoId, $userId), "ii");
	$count = $result[0][0];
	if ($count > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function UpdateCurrentlyWatchingInDatabase($currentlyWatching)
{
	$query = "update currentlywatching set timestamp=?, finished=? where videoid=? and userid=?";
	$parameters = array(
		$currentlyWatching->timestamp,
		$currentlyWatching->finished,
		$currentlyWatching->videoId,
		$currentlyWatching->userId
	);
	return Execute($query, $parameters, "diii");
}

function GetCurrentlyWatchingsByUser($userId)
{
	$query = "select * from currentlywatching where userid=? and not(finished)";
	$result = Fetch($query, array($userId), "i");
	if ($result)
	{
		$currentlyWatchings = array();
		foreach ($result as $row)
		{
			$currentlyWatchings[] = ConvertToCurrentlyWatching($row);
		}
		return $currentlyWatchings;
	}
	else
	{
		return array();
	}
}

function GetCurrentlyWatchingFromDatabase($userId, $videoId)
{
	$result = Fetch("select * from currentlywatching where userid=? and videoid=?", array($userId, $videoId), "ii");
	if ($result)
	{		
		if (count($result) > 0)
		{
			return ConvertToCurrentlyWatching($result[0]);
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

function ConvertToCurrentlyWatching($row)
{
	$currentlyWatching = new CurrentlyWatching();
	$currentlyWatching->videoId = $row[0];
	$currentlyWatching->userId = $row[1];
	$currentlyWatching->timestamp = $row[2];
	$currentlyWatching->finished = $row[3];
	return $currentlyWatching;
}

?>