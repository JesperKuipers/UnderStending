<?php

function AddCurrentlyWatchingToDatabase($currentlyWatching)
{
	$query = "insert into currentlywatching values (?, ?, ?)";
	
	$parameters = array(
		$currentlyWatching->videoId,
		$currentlyWatching->userId,
		$currentlyWatching->timestamp
	);
	
	return Execute($query, $parameters, "iii");
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
	$query = "update currentlywatching set timestamp=? where videoid=? and userid=?";
	$parameters = array(
		$currentlyWatching->timestamp,
		$currentlyWatching->videoId,
		$currentlyWatching->userId
	);
	return Execute($query, $parameters, "iii");
}

function GetCurrentlyWatchingsByUser($userId)
{
	$query = "select * from currentlywatching where userid=?";
	$result = Fetch($query, array($userId), "i");
	$currentlyWatchings = array();
	foreach ($result as $row)
	{
		$currentlyWatching = new CurrentlyWatching();
		$currentlyWatching->videoId = $row[0];
		$currentlyWatching->userId = $row[1];
		$currentlyWatching->timestamp = $row[2];
		$currentlyWatchings[] = $currentlyWatching;
	}
	return $currentlyWatchings;
}

?>