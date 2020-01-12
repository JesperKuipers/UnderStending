<?php

function AddPlaylistToDatabase($playlist)
{
	//Uit te voeren query
	$query = "insert into playlist values (null, ?, ?)";
	//Query parameters
	$params = array($playlist->userId, $playlist->name);
	//Voer query uit
	if (!Execute($query, $params, "is"))
	{
		return false;
	}
	//Haal gecreërde playlistid op
	$playlistId = Fetch("select max(playlistid) from playlist")[0][0];
	//Geef playlistId terug
	return $playlistId;
}

function GetPlaylistsFromDatabase($index, $limit)
{
	$result = Fetch("select * from playlist limit ?, ?", array($index, $limit), "ii");
	if (!$result)
	{
		return false;
	}
	else
	{
		$playlists = array();
		foreach ($result as $row)
		{
			$playlist = new Playlist();
			$playlist->playlistId = $row[0];
			$playlist->userId = $row[1];
			$playlist->name = $row[2];
			$playlists[] = $playlist;
		}
		return $playlists;
	}
}

function GetPlaylistById($playlistId)
{
	$result = Fetch("select * from playlist where playlistid=?", array($playlistId), "i");
	if (!$result)
	{
		return false;
	}
	else
	{
		if (count($result) == 0)
		{
			return false;
		}
		else
		{
			$row = $result[0];		
			$playlist = new Playlist();
			$playlist->playlistId = $row[0];
			$playlist->userId = $row[1];
			$playlist->name = $row[2];		
			return $playlist;
		}
	}
}

?>