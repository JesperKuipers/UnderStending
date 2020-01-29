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
	if ($result)
	{
		//geef playlist array terug
		return ConvertResultToPlaylists($result);
	}
	else
	{
		return false;
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

function UpdatePlaylistInDatabase($playlist)
{
	return Execute("update playlist set name=? where playlistid=?", array($playlist->name, $playlist->playlistId), "si");
}

function GetPlaylistsByUserFromDatabase($userId)
{
	//Haal playlist rows op
	$result = Fetch("select * from playlist where userid=?", array($userId), "i");
	if ($result)
	{
		//geef playlist array terug
		return ConvertResultToPlaylists($result);
	}
	else
	{
		return false;
	}
}

function RemovePlaylistFromDatabase($playlistId)
{
	return Execute("delete from playlist where playlistid=?", array($playlistId), "i");
}

function GetNonAddedPlaylistsFromDatabase($userId, $videoId)
{
	$query = "select * from playlist where userid=? and playlistid not in (select playlistid from playlistvideo where videoid=?)";
	$result = Fetch($query, array($userId, $videoId), "ii");
	if ($result)
	{
		//geef playlist array terug
		return ConvertResultToPlaylists($result);
	}
	else
	{
		return false;
	}
}

function ConvertResultToPlaylists($result)
{
	$playlists = array();
	foreach ($result as $row)
	{
		//voeg playlist object toe aan array
		$playlists[] = ConvertRowToPlaylist($row);
	}
	//geef playlist array terug
	return $playlists;
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