<?php

function GetUserById($userId)
{
	//Haal users op uit database
	$result = Fetch("select * from user where userid = ?", array($userId), "i");
	//Pak user uit users array
	$userRow = $result[0];
	//Creëer nieuw user object
	$user = new User();
	//Wijs waardes toe aan user object
	$user->userId = $userRow[0];
	$user->userTypeId = $userRow[1];
	$user->name = $userRow[2];
	$user->email = $userRow[3];
	$user->password = $userRow[4];
	$user->admin = $userRow[5];
	//Geef user object terug aan functie caller
	return $user;
}

?>