<?php

function GetVideo($videoId)
{
	//Haal video op
	$video = GetVideoById($videoId);
	if ($video)
	{
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
	else
	{
		return false;
	}
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
	
?>