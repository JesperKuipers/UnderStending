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
			$playlists[] = ConvertRowToPlaylist($row);
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
			return ConvertRowToPlaylist($result[0]);
		}
	}
}

function UpdatePlaylist($Playlist)
{
	return Execute("UPDATE playlist SET name = ? WHERE playlistid = ?", array($Playlist->name, $Playlist->playlistId), 'si');
}

function GetPlaylistsByUserFromDatabase($userId)
{
	//Haal playlist rows op
	$result = Fetch("select * from playlist where userid=?", array($userId), "i");
	if ($result)
	{
		//creëer playlist array
		$playlists = array();
		foreach ($result as $row)
		{
			//voeg playlist object toe aan array
			$playlists[] = ConvertRowToPlaylist($row);
		}
		//geef playlist array terug
		return $playlists;
	}
	else
	{
		return false;
	}
}

function ConvertRowToPlaylist($row)
{
	$playlist = new Playlist();
	$playlist->playlistId = $row[0];
	$playlist->userId = $row[1];
	$playlist->name = $row[2];		
	return $playlist;
}

?>