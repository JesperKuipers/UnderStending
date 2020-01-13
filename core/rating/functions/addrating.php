<?php

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