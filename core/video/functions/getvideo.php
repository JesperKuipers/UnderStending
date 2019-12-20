<?php
	function GetVideo($videoId)
	{
		//Haal video op
		$video = GetVideoById($videoId);
		//Haal gebruiker op
		$user = GetUserById($video->userId);
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
		$videoResult->rating = $averageRating;
		$videoResult->userId = $user->userId;
		$videoResult->userName = $user->name;
		//Geef het gecreëerde object terug
		return $videoResult;
	}
	
	function GetAverageRating($ratings)
	{
		//Bereken de gemiddelde score van de beoordelingen
		$ratingNumbers = array();
		foreach ($ratings as $rating)
		{
			$ratingNumbers[] = $rating->rating;
		}
		return (array_sum($ratingNumbers) / count($ratingNumbers));
	}
	
	class GetVideoResult
	{
		public $videoId;
		public $title;
		public $description;
		public $videoUrl;
		public $thumbnailUrl;
		public $rating;
		public $userId;
		public $userName;
	}
?>