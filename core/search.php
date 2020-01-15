<?php

function Search($query)
{
	$videos = "	SELECT videoID, title, thumbnail, thumbnailExtension
				FROM video 
				WHERE approved = 1 
				AND title LIKE ?;";

	$tags = "	SELECT t.tagID, t.name, v.thumbnail, v.thumbnailExtension
				FROM tag t
				INNER JOIN videotag vt ON t.tagID = vt.tagID
				INNER JOIN video v ON vt.videoID = v.videoID
				WHERE t.name LIKE ?
				GROUP BY t.tagID";
				
	$playlists = "SELECT p.playlistID, p.name, v.thumbnail, v.thumbnailExtension
				FROM playlist p
				INNER JOIN playlistvideo pv ON p.playlistID = pv.playlistID
				INNER JOIN video v ON pv.videoID = v.videoID
				WHERE p.name LIKE ?
				GROUP BY p.playlistID";
	
	$query = "%" . $query . "%";
	
	$videosResult = Fetch($videos, array($query), "s");
	$tagsResult = Fetch($tags, array($query), "s");
	$playlistsResult = Fetch($playlists, array($query), "s");
	
	if($videosResult === FALSE || $tagsResult === FALSE || $playlistsResult === FALSE)
	{
		return false;
	}
	else
	{
		$results = array();
		foreach($videosResult as $row)
		{
			$video = new Video();
			$video->videoId = $row[0];
			$video->title = $row[1];
			$video->thumbnailId = $row[2];
			$video->thumbnailExtension = $row[3];
			$results["videos"][] = $video;
		}
		foreach($tagsResult as $row)
		{
			$tag = new Tag();
			$tag->tagId = $row[0];
			$tag->name = $row[1];
			$tag->thumbnailId = $row[2];
			$tag->thumbnailExtension = $row[3];
			$results["tags"][] = $tag;
		}
		foreach($playlistsResult as $row)
		{
			$playlist = new Playlist();
			$playlist->playlistId = $row[0];
			$playlist->name = $row[1];
			$playlist->thumbnailId = $row[2];
			$playlist->thumbnailExtension = $row[3];
			$results["playlists"][] = $playlist;
		}
		return $results;
	}
}

?>