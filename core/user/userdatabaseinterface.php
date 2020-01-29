<?php

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
	return ConvertRowToUser($result[0]);
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

?>