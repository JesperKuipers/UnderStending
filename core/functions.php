<?php

class CurrentlyWatching
{
	public $videoId;
	public $userId;
	public $timestamp;
}



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



function CreateOrUpdateCurrentlyWatching($videoId, $userId, $timestamp)
{
	$user = GetUserById($userId);
	if (!$user)
	{
		return "De gebruiker is niet gevonden.";
	}
	
	$video = GetVideoById($videoId);
	if (!$video)
	{
		return "De video is niet gevonden.";
	}
	
	$currentlyWatching = new CurrentlyWatching();
	$currentlyWatching->videoId = $videoId;
	$currentlyWatching->userId = $userId;
	$currentlyWatching->timestamp = $timestamp;
	
	if (CurrentlyWatchingExists($videoId, $userId))
	{
		UpdateCurrentlyWatchingInDatabase($currentlyWatching);
	}
	else
	{
		AddCurrentlyWatchingToDatabase($currentlyWatching);
	}
}



function Execute($query, $params = array(), $types = "")
{
	if (!$conn = mysqli_connect('localhost', 'root', '', 'understendingdb'))
	{
		return false;//mysqli_connect_error($conn);
	}
	else
	{
		if (!$stmt = mysqli_prepare($conn, $query))
		{
			return false;//mysqli_error($conn);
		}
		else
		{ 
			if (!empty($types))
			{
				if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
				{
					return false;//return mysqli_stmt_error($stmt);
				}
			}
			if (!mysqli_stmt_execute($stmt))
			{
				return false;//mysqli_stmt_error($stmt);
			}
			else
			{
				return true;
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
}

function Fetch($query, $params = array(), $types = "")
{
	if (!$conn = mysqli_connect('localhost', 'root', '', 'understendingdb'))
	{
		return false;//mysqli_connect_error($conn);
	}
	else
	{
		if (!$stmt = mysqli_prepare($conn, $query))
		{
			return false;//mysqli_error($conn);
		}
		else
		{
			if (!empty($types))
			{
				if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
				{
					return false;//mysqli_stmt_error($stmt);
				}
			}
			if (!mysqli_stmt_execute($stmt))
			{
				return false;//mysqli_stmt_error($stmt);
			}
			else
			{
				$result = mysqli_stmt_get_result($stmt);
				return mysqli_fetch_all($result);
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
}


	
function GenerateGuid()
{
	//Creerd een "GUID" {https://nl.wikipedia.org/wiki/Globally_unique_identifier}		
	mt_srand((double)microtime()*10000);
	$charid = strtoupper(md5(uniqid(rand(), true)));
	$hyphen = chr(45);
	return substr($charid, 0, 8).$hyphen
		.substr($charid, 8, 4).$hyphen
		.substr($charid,12, 4).$hyphen
		.substr($charid,16, 4).$hyphen
		.substr($charid,20,12);
		
	//Voorbeeld: 1e3f9c59-6fed-4479-9446-2dc81e2bbf2c
}

//Bij het creeeren van entiteiten wordt er een nieuwe sleutel gemaakt op basis de functie hierboven.
//Als er een dubbele sleutel is gecreerd wordt er een nieuwe gegenereerd.


function getVideoID() {
	if(isset($_GET["v"])) {
		$videoID = filter_input(INPUT_GET, 'v', FILTER_VALIDATE_INT);
		if (!$videoID) {
			return false;
		} else {
			return $videoID;
		}
	}
	else if(isset($_GET["id"])) {
		$videoID = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
		if (!$videoID) {
			return false;
		} else {
			return $videoID;
		}
	}
}


function CreatePlaylist($userId, $name)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of gebruiker wel bestaat
	if (!$user)
	{
		return false;
	}
	//Creër playlist object
	$playlist = new Playlist();
	$playlist->userId = $user->userId;
	$playlist->name = $name;
	//Voeg playlist toe aan database
	$playlistId = AddPlaylistToDatabase($playlist);
	//Geef gecreërde playlistid terug
	return $playlistId;
}



function GetPlaylist($playlistId)
{
	//Haal playlist op
	$playlist = GetPlaylistById($playlistId);
	//Haal playlistvideos op o.b.v playlist
	$playlistVideos = GetPlaylistVideosByPlaylist($playlistId);
	//Kijk of playlist daadwerkelijk is opgehaald
	if ($playlist)
	{
		//Creëer nieuwe getplaylistresult
		$getPlaylistResult = new GetPlaylistResult();
		//Wijs properties toe
		$getPlaylistResult->playlistId = $playlist->playlistId;
		$getPlaylistResult->userId = $playlist->userId;
		$getPlaylistResult->name = $playlist->name;
		//Wijs thumbnailurl toe wanneer videotags aanwezig zijn
		if (empty($playlistVideos))
		{
			$getPlaylistResult->thumbnailUrl = false;
		}
		else
		{
			$video = GetVideoById($playlistVideos[0]->videoId);
			$getPlaylistResult->thumbnailUrl = $video->ThumbnailUrl();
		}
		//Geef getplaylistresult object terug
		return $getPlaylistResult;
	}
	else
	{
		return false;
	}
}



function GetPlaylists($index, $limit)
{
	$playlists = GetPlaylistsFromDatabase($index, $limit);
	if (!$playlists)
	{
		return false;
	}
	else
	{
		return $playlists;
	}
}



function GetPlaylistsByUser($userId)
{
	$playlists = GetPlaylistsByUserFromDatabase($userId);
	if ($playlists)
	{
		return $playlists;
	}
	else
	{
		return array();
	}
}



class GetPlaylistResult
{
	public $playlistId;
	public $userId;
	public $name;
	public $thumbnailUrl;
}



class Playlist
{
	public $playlistId;
	public $userId;
	public $name;
}



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
		return ConvertRowsToPlaylists($result);
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
			//Converteer row naar playlist
			return ConvertRowToPlaylist($result[0]);
		}
	}
}

function GetPlaylistsByUserFromDatabase($userId)
{
	$result = Fetch("select * from playlist where userid=?", array($userId), "i");
	if ($result)
	{
		return ConvertRowsToPlaylists($result);		
	}
	else
	{
		return false;
	}
}

function ConvertRowsToPlaylists($rows)
{
	$playlists = array();
	foreach ($rows as $row)
	{
		$playlists[] = ConvertRowToPlaylist($row);
	}
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



function CreatePlaylistVideo($playlistId, $videoId)
{
	//haal playlist op
	$playlist = GetPlaylistById($playlistId);
	//geef false terug wanneer playlist niet is gevonden
	if (!$playlist)
	{
		return false;
	}
	//haal video op
	$video = GetVideoById($videoId);
	//geef false terug wanneer video niet gevonden
	if (!$video)
	{
		return false;
	}
	//creëer nieuw playlistvideo object
	$playlistVideo = new PlaylistVideo();
	//wijs properties toe
	$playlistVideo->videoId = $videoId;
	$playlistVideo->playlistId = $playlistId;
	//voeg playlistvideo toe aan de database
	return AddPlaylistVideoToDatabase($playlistVideo);
}



function GetPlaylistVideosByPlaylist($playlistId)
{
	$playlistVideos = GetPlaylistVideosByPlaylistId($playlistId);
	if ($playlistVideos)
	{
		return $playlistVideos;
	}
	else
	{
		return array();
	}
}



class PlaylistVideo
{
	public $videoId;
	public $playlistId;
}



function RemovePlaylistVideos($videoId)
{
	Execute("delete from playlistvideo where videoid=?", array($videoId), "i");
}

function GetPlaylistVideosByPlaylistId($playlistId)
{
	$result = Fetch("select * from playlistvideo where playlistid=?", array($playlistId), "i");
	$playlistVideos = array();
	foreach ($result as $row)
	{
		$playlistVideo = new PlaylistVideo();
		$playlistVideo->videoId = $row[0];
		$playlistVideo->playlistId = $row[1];
		$playlistVideos[] = $playlistVideo;
	}
	return $playlistVideos;
}

function AddPlaylistVideoToDatabase($playlistVideo)
{
	$query = "insert into playlistvideo values (?, ?)";
	
	$parameters = array(
		$playlistVideo->videoId,
		$playlistVideo->playlistId
	);
	
	return Execute($query, $parameters, "ii");
}



function addRating($videoId, $userId, $rating)
{
	//Haal de gebruiker op uit de database
	$user = GetUserById($userId);
	//Maak een nieuw video object
	$tag = new Rating();
	//Wijs waardes toe aan video object
	$tag->userId = $user->userId;
	$tag->videoId = $videoId;
	$tag->rating = $rating;
	//Voeg het object toe aan de database
	return AddRatingToDatabase($tag);
}

class Rating
{
	public $videoId;
	public $userId;
	public $rating;
}



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
			$playlist->playlistID = $row[0];
			$playlist->name = $row[1];
			$playlist->thumbnailId = $row[2];
			$playlist->thumbnailExtension = $row[3];
			$results["playlists"][] = $tag;
		}
		return $results;
	}
}



function CreateTag($userId, $name)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of de tag al bestaat
	if (TagNameExists($name))
	{
		return false;
	}
	//Add tag
	return AddTagToDatabase($name);
}



function GetTag($tagId)
{
	//Haal tag op
	$tag = GetTagById($tagId);
	//Haal videoTags op o.b.v tag
	$videoTags = GetVideoTagsByTag($tagId, 1);
	//Geef false terug wanneer tag niet bestaad
	if (!$tag)
	{
		return false;
	}
	else
	{
		//Creëer nieuwe getTagResult
		$getTagResult = new GetTagResult();
		//Zet properties
		$getTagResult->tagId = $tag->tagId;
		$getTagResult->name = $tag->name;
		//Wijs een thumbnailUrl toe aan de tag wanneer de videotags niet leeg zijn
		if (empty($videoTags))
		{
			$getTagResult->thumbnailUrl = false;
		}
		else
		{
			$video = GetVideoById($videoTags[0]->videoId);
			$getTagResult->thumbnailUrl = $video->thumbnailUrl();
		}
		//Geef getTagResult terug
		return $getTagResult;
	}
}



function GetTags($index, $limit)
{
	//haal tags op uit database
	$tags = GetTagsFromDatabase($index, $limit);
	//creëer tagswiththumbnail array
	$tagsWithThumbnails = array();
	//Geef lege array terug wanneer tags niet bestaan
	if (!$tags)
	{
		return array();
	}
	else
	{
		//Lus door de tags heen
		foreach ($tags as $tag)
		{
			//Haal tag op met de eerste video thumbnail
			$tagsWithThumbnails[] = GetTag($tag->tagId);			
		}
		//Geef tags terug met thumbnail
		return $tagsWithThumbnails;
	}
}



function GetTagsByVideo($videoId)
{
	$videoTags = GetVideoTagsByVideo($videoId);
	$tags = array();
	foreach ($videoTags as $videoTag)
	{
		$tags[] = GetTag($videoTag->tagId);
	}
	return $tags;
}



function RemoveTag($userId, $tagId)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Verwijder videotags afhankelijk van de te verwijderen tag
	RemoveVideoTagsByTag($tagId);
	//Verwijder tag
	RemoveTagFromDatabase($tagId);
}



class GetTagResult
{
	public $tagId;
	public $name;
	public $thumbnailUrl;
}



class Tag
{
	public $tagId;
	public $name;
}



function TagNameExists($name)
{
	//Doe een count op alle tags met dezelfde naam in de database
	$result = Fetch("select count(*) from tag where name=?", array($name), "s");
	//Haal de count op uit de resultset
	$count = $result[0][0];
	//Groter? bestaat kleiner of gelijk aan? bestaat nog niet
	if ($count > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function GetTagIdByName($name)
{
	//Haal de tag op o.b.v de naam
	$result = Fetch("select tagid from tag where name=?", array($name), "s");
	//Kijk of resultaatset leeg is
	if ($result == 0)
	{
		return false;
	}
	else
	{
		//Haal tagid uit de resultaatset
		$tagId = $result[0][0];
		//Geef tagId terug
		return $tagId;
	}
}

function AddTagToDatabase($name)
{
	//Insert tag in database
	Execute("insert into tag values (null, ?)", array($name), "s");
	//Haal gecreërde tagId op uit de database
	$tagId = Fetch("select max(tagid) from tag")[0][0];
	//Geef de gecreërde tag terug
	return $tagId;
}

function GetTagById($tagId)
{
	//Haal alle tags op uit de database waar de id gelijk is
	$result = Fetch("select * from tag where tagid=?", array($tagId), "i");
	//Geen resultaten? geef false terug
	if ($result == 0)
	{
		return false;
	}
	else
	{
		//Haal eerste tag op uit resultset
		$row = $result[0];
		//Creëer nieuw object
		$tag = new Tag();
		//Wijs object variabelen toe
		$tag->tagId = $row[0];
		$tag->name = $row[1];
		//Geef tag terug
		return $tag;
	}
}

function RemoveTagFromDatabase($tagId)
{
	Execute("delete from tag where tagid=?", array($tagId), "i");
}

function GetTagsFromDatabase($index, $limit)
{
	$result = Fetch("select * from tag limit ?, ?", array($index, $limit), "ii");

	if (!$result)
	{
		return false;
	}
	else
	{
		$tags = array();
		foreach ($result as $row)
		{
			$tag = new Tag();
			$tag->tagId = $row[0];
			$tag->name = $row[1];
			$tags[] = $tag;
		}
		return $tags;
	}
}



function GetAdministrator($userId)
{
	$admin = GetAdminFromDatabase($userId);
	if ($admin)
	{
		return $admin;
	}
	else
	{
		return false;
	}
}



class User
{
	public $userId;
	public $userTypeId;
	public $name;
	public $email;
	public $password;
	public $admin;
}



function GetUserById($userId)
{
	//Haal user op uit database
	$result = Fetch("select * from user where userid = ?", array($userId), "i");
	//Kijk of er geen gebruiker is gevonden
	if ($result == 0)
	{
		return false;
	}
	//Geef row terug als user
	return  ConvertRowToUser($result[0]);
}

function GetAdminFromDatabase($userId)
{
	//Haal admin op uit database
	$result = Fetch("select * from user where userid = ? and admin=?", array($userId, 1), "ii");
	//Kijk of er geen gebruiker is gevonden
	if ($result == 0 || !$result)
	{
		return false;
	}
	//Geef row terug als user
	return ConvertRowToUser($result[0]);
}

function ConvertRowToUser($row)
{
	//Creëer nieuw user object
	$user = new User();
	//Wijs waardes toe aan user object
	$user->userId = $row[0];
	$user->userTypeId = $row[1];
	$user->name = $row[2];
	$user->email = $row[3];
	$user->password = $row[4];
	$user->admin = $row[5];
	//Geef user object terug aan functie caller
	return $user;
}



function ApproveVideo($userId, $videoId)
{
	$user = GetUserById($userId);
	if (!$user->admin)
	{
		return false;
	}
	
	$video = GetVideoById($videoId);
	$video->approved = true;
	$video->releaseDate = time();
	
	UpdateVideoInDatabase($video);
}



function CreateAndAddTagsToVideo($userId, $videoId, $names)
{
	$tagIds = array();
	//Loop door alle te creëren tags heen
	foreach ($names as $name)
	{
		//Creër tags
		$tagId = CreateTag($userId, $name);
		//Tag bestaat al?
		if (!$tagId)
		{
			//Haal tag op o.b.v naam
			$tagId = GetTagIdByName($name);
		}
		$tagIds[] = $tagId;
	}
	
	//Loop door alle tagIds heen
	foreach ($tagIds as $tagId)
	{
		//Voeg videotags o.b.v van de gecreërde tag
		AddVideoTag($userId, $videoId, $tagId);
	}
}



function CreateVideo($userId, $title, $description, $video, $thumbnail)
{
	//Haal de gebruiker op uit de database
	$user = GetUserById($userId);
	//Sla de video op en haal unieke sleutel op
	$urlId = AddVideoToFileSystem($video);
	//Kijk of de video goed is opgeslagen op het filesysteem
	if (!$urlId)
	{
		return false;
	}
	//Sla de thumbnail op en haal unieke sleutel op
	$response = AddThumbnailToFileSystem($thumbnail);
	//Kijk of de thumbnail goed is opgeslagen op het filsysteem
	if (!$response)
	{
		return false;
	}
	//Maak een nieuw video object
	$video = new Video();
	//Wijs waardes toe aan video object
	$video->uploader = $user->userId;
	$video->title = $title;
	$video->description = $description;
	$video->approved = false;
	$video->urlId = $urlId;
	$video->thumbnailId = $response->thumbnailUrlId;	
	$video->thumbnailExtension = $response->extension;
	//Voeg het object toe aan de database
	return AddVideoToDatabase($video);
}



function GetCurrentVideo($userId)
{
	$user = GetUserById($userId);
	if (!$user)
	{
		return false;
	}
	
	$currentlyWatchings = GetCurrentlyWatchingsByUser($userId);
	if (count($currentlyWatchings) > 0)
	{
		$currentlyWatching = $currentlyWatchings[0];
		$videoId = $currentlyWatching->videoId;
		return GetVideo($videoId);
	}
	else
	{
		return false;
	}
}



function GetNonApprovedVideos($index, $limit)
{
	$videos = GetNonApprovedVideosFromDatabase($index, $limit);
	if ($videos)
	{
		return $videos;
	}
	else
	{
		return array();
	}
}



function GetNonApprovedVideosCount()
{
	return GetNonApprovedVideosCountFromDatabase();
}



function GetVideo($videoId)
{
	//Haal video op
	$video = GetVideoById($videoId);
	//Haal gebruiker op
	$user = GetUserById($video->uploader);
	//Haal alle beoordelingen van de video
	$ratings = GetRatingsByVideoId($video->videoId);
	//Bereken de gemiddelde score van de beoordelingen
	$averageRating = GetAverageRating($ratings);
	//Haal de thumbnail en de video url op
	$thumbnailUrl = GetThumbnailUrl($video->thumbnailId, $video->thumbnailExtension);
	$videoUrl = GetVideoUrl($video->urlId);		
	//Creëer een nieuw object met alle benodigde attributen voor het laten zien van de video
	$videoResult = new GetVideoResult();
	$videoResult->videoId = $video->videoId;
	$videoResult->title = $video->title;
	$videoResult->description = $video->description;
	$videoResult->videoUrl = $videoUrl;
	$videoResult->thumbnailUrl = $thumbnailUrl;
	$videoResult->approved = $video->approved;
	$videoResult->rating = $averageRating;
	$videoResult->uploader = $user->userId;
	$videoResult->uploaderName = $user->name;
	//Geef het gecreëerde object terug
	return $videoResult;
}

function GetAverageRating($ratings)
{
	if (empty($ratings))
	{
		return 0;
	}
	//Bereken de gemiddelde score van de beoordelingen
	$ratingNumbers = array();
	foreach ($ratings as $rating)
	{
		$ratingNumbers[] = $rating->rating;
	}
	return (array_sum($ratingNumbers) / count($ratingNumbers));
}
	


function GetVideos($limit)
{
	$videos = GetVideosFromDatabase($limit);
	if (!$videos)
	{
		return array();
	}
	else
	{
		return $videos;
	}
}



function GetVideosByPlaylist($playlistId)
{
	//haal playlistvideo op
	$playlistVideos = GetPlaylistVideosByPlaylistId($playlistId);
	//creëer video's array
	$videos = array();
	//lus door de playlistvideo's heen
	foreach ($playlistVideos as $playlistVideo)
	{
		//haal video op op basis van playlistvideo
		$video = GetVideo($playlistVideo->videoId);
		//voeg video toe aan video's array
		$videos[] = $video;
	}
	//geef video's array terug
	return $videos;
}



function GetVideosByTag($tagId, $limit)
{
	//Haal videotags op
	$videotags = GetVideoTagsByTag($tagId, $limit);
	//Creëer video array
	$videos = array();
	//Lus door gevonden videotags heen
	foreach ($videotags as $videotag)
	{
		//Verwijs de videos aan de array
		$videos[] = GetVideoById($videotag->videoId);
	}
	//Geef array terug
	return $videos;
}



function GetVideosByUser($userId)
{
	$videos = GetVideosByUserFromDatabase($userId);
	if ($videos)
	{
		return $videos;
	}
	else
	{
		return array();
	}
}



function RemoveVideo($videoId, $userId)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of user een admin is of userid gelijk is aan de uploader
	if (!$user->admin || $video->uploader != $userId)
	{
		return false;
	}
	//Verwijder tabel relaties
	RemoveRatingsByVideo($videoId);
	RemovePlaylistVideos($videoId);
	RemoveVideoTags($videoId);
	//Verwijder video inhoud van het file systeem
	RemoveVideoFromFileSystem($video->urlId);
	RemoveThumbnailFromFileSystem($video->thumbnailId, $video->thumbnailExtension);
	//Verwijder video
	RemoveVideoFromDatabase($videoId);
}



class GetVideoResult
{
	public $videoId;
	public $title;
	public $description;
	public $videoUrl;
	public $thumbnailUrl;
	public $approved;
	public $rating;
	public $uploader;
	public $uploaderName;
}



class Video
{
	public $videoId;
	public $uploader;
	public $title;
	public $releaseDate;
	public $description;
	public $approved;
	public $urlId;
	public $thumbnailId;
	public $thumbnailExtension;
	
	public function ThumbnailUrl()
	{
		return GetThumbnailUrl($this->thumbnailId, $this->thumbnailExtension);
	}
	
	public function VideoUrl()
	{
		return GetVideoUrl($this->urlId);
	}
}



function AddVideoToDatabase($video)
{
	//Creëer query
	$statement = "insert into video values (0, ?, ?, '', ?, ?, 0, ?, ?)";	
	//Creëer query parameters
	$parameters = array(
		$video->uploader,
		$video->title,
		$video->description,
		$video->urlId,
		$video->thumbnailId,
		$video->thumbnailExtension
	);
	//Voeg video toe aan database
	if (Execute($statement, $parameters, "isssss"))
	{
		return Fetch("select max(videoid) from video")[0][0];
	}
	else
	{
		return false;
	}
}

function GetVideoById($videoId)
{
	//Haal videos op uit database
	$result = Fetch("select * from video where videoid = ?", array($videoId), "i");
	//Pak user uit users array
	$row = $result[0];
	//Geef video object terug aan functie caller
	return ConvertRowToVideo($row);
}

function GetRatingsByVideoId($videoId)
{
	//Haal ratings op uit database
	$result = Fetch("select * from rating where videoid = ?", array($videoId), "i");
	//Lus door de rows
	$ratings = array();
	foreach ($result as $row)
	{
		//Creëer een nieuw rating object
		$rating = new Rating();
		$rating->videoId = $row[0];
		$rating->userId = $row[1];
		$rating->rating = $row[2];
		//Voeg de rating toe aan alle ratings
		$ratings[] = $rating;
	}
	//Geef alle ratings terug
	return $ratings;
}

function RemoveVideoFromDatabase($videoId)
{
	Execute("delete from video where videoid=?", array($videoId), "i");
}

function UpdateVideoInDatabase($video)
{
	$query = "update video set title=?, description=?, approved=?, thumbnail=?, thumbnailextension=? where videoid=?";
	
	$params = array(
		$video->title,
		$video->description,
		$video->approved,
		$video->thumbnailId,
		$video->thumbnailExtension,
		$video->videoId
	);
	
	Execute($query, $params, "ssissi");
}

function GetVideosFromDatabase($limit)
{
	$result = Fetch("SELECT * FROM video LIMIT ?", array($limit), "i");
	if (!$result)
	{
		return false;
	}
	else
	{
		$videos = array();
		foreach ($result as $row)
		{
			$videos[] = ConvertRowToVideo($row);
		}
		return $videos;
	}
}

function GetNonApprovedVideosFromDatabase($index, $limit)
{
	$result = Fetch("select * from video where not(approved) limit ?, ?", array($index, $limit), "ii");
	if ($result)
	{
		$videos = array();
		foreach ($result as $row)
		{
			$videos[] = ConvertRowToVideo($row);
		}
		return $videos;
	}
	else
	{
		return false;
	}
}

function GetNonApprovedVideosCountFromDatabase()
{
	$result = Fetch("select count(*) from video where not(approved)");
	if ($result)
	{
		return $result[0][0];
	}
	else
	{
		return false;
	}
}

function GetVideosByUserFromDatabase($userId)
{
	$result = Fetch("select * from video where userid=?", array($userId), "i");
	if ($result === false)
	{
		return false;
	}	
	return ConvertRowsToVideos($result);
}

function ConvertRowsToVideos($rows)
{
	$videos = array();
	foreach ($rows as $row)
	{
		$videos[] = ConvertRowToVideo($row);
	}
	return $videos;
}

function ConvertRowToVideo($row)
{
	$video = new Video();
	$video->videoId = $row[0];
	$video->uploader = $row[1];
	$video->title = $row[2];
	$video->releaseDate = $row[3];
	$video->description = $row[4];
	$video->urlId = $row[5];
	$video->approved = $row[6];
	$video->thumbnailId = $row[7];
	$video->thumbnailExtension = $row[8];
	return $video;
}



function AddVideoToFileSystem($video)
{
	//Pad naar videos
	$videoPath = getcwd() . "/videos/";
	//Genereer nieuwe guid voor video
	$videoFileSystemId = GenerateGuid();
	//Geef false terug wanneer video geen mp4 is
	if ($video["type"] != "video/mp4")
	{
		return false;
	}
	//Verplaats video van tijdelijk naar permanente opslag
	if (move_uploaded_file($video["tmp_name"], $videoPath . $videoFileSystemId . ".mp4"))
	{
		//Geef sleutel van video terug
		return $videoFileSystemId;
	}
	else
	{
		return false;
	}
}

function AddThumbnailToFileSystem($thumbnail)
{
	//Bepaal extensie van afbeelding
	$extension = "";
	switch ($thumbnail["type"])
	{
		case "image/gif":
			$extension = "gif";
			break;
		case "image/jpeg":
			$extension = "jpg";
			break;
		case "image/jpg":
			$extension = "jpg";
			break;
		case "image/png":
			$extension = "png";
			break;
	}
	//Geef false terug wanneer extensie niet is gevonden
	if (empty($extension))
	{
		return false;
	}
	//Pad naar thumbnails
	$thumbnailPath = getcwd() . "/imgs/thumbnails/";
	//Genereer nieuwe guid voor thumbnail
	$thumbnailUrlId = GenerateGuid();
	//Verplaats thumbnail van tijdelijk naar permanente opslag
	if (move_uploaded_file($thumbnail["tmp_name"], $thumbnailPath . $thumbnailUrlId . "." . $extension))
	{
		//Geef sleutel en extension van de thumbnail terug
		$response = new AddThumbnailToFileSystemResponse();
		$response->thumbnailUrlId = $thumbnailUrlId;
		$response->extension = $extension;
		return $response;
	}
	else
	{
		return false;
	}
}

class AddThumbnailToFileSystemResponse
{
	//File systeem id van de thumbnail
	public $thumbnailUrlId;
	//Extentie van de thumbnail
	public $extension;
}

function GetVideoUrl($videoUrlId)
{
	//Url naar specifieke video
	return "videos/{$videoUrlId}.mp4";
}

function GetThumbnailUrl($thumbnailUrlId, $extension)
{
	//Url naar specifieke thumbnail
	return "imgs/thumbnails/{$thumbnailUrlId}.{$extension}";
}

function RemoveThumbnailFromFileSystem($thumbnailUrlId, $extension)
{
	//Pad naar thumbnails
	$thumbnailPath = getcwd() . "/imgs/thumbnails/";
	//Verwijder thumbnail uit het file systeem
	unlink("{$thumbnailPath}{$thumbnailUrlId}.{$extension}");
}

function RemoveVideoFromFileSystem($videoUrlId)
{
	//Pad naar videos
	$videoPath = getcwd() . "/videos/";
	//Verwijder video uit het file systeem
	if (unlink("{$videoPath}{$videoUrlId}.mp4"))
	{
		return true;
	}
	else
	{
		return false;
	}	
}



function AddVideoTag($userId, $videoId, $tagId)
{
	//Haal user op
	$user = GetUserById($userId);
	//Haal video op
	$video = GetVideoById($videoId);
	//Kijk of user recht heeft om videotags te creëren
	if ($video->uploader != $userId || !$user->admin)
	{
		return false;
	}
	//Haal tag op
	$tag = GetTagById($tagId);
	//Voeg videotag toe
	return AddVideoTagToDatabase($videoId, $tagId);
}



function GetVideoTagsByVideo($videoId)
{
	$videoTags = GetVideoTagsByVideoId($videoId);
	if (!$videoTags)
	{
		return array();
	}
	else
	{
		return $videoTags;
	}
}



function RemoveVideoTag($userId, $videoId, $tagId)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Verwijder videotag
	RemoveVideoTagFromDatabase($videoId, $tagId);
}



class VideoTag
{
	public $videoId;
	public $tagId;
}



function AddVideoTagToDatabase($videoId, $tagId)
{
	return Execute("insert into videotag values (?, ?)", array($videoId, $tagId), "ii");
}

function RemoveVideoTags($videoId)
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
	Execute("delete from videotag where tagid=?", array($tagId), "i");
}

function RemoveVideoTagFromDatabase($videoId, $tagId)
{
	Execute("delete from videotag where videoid=? and tagid=?", array($videoId, $tagId), "ii");
}

?>