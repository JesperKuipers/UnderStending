<?php

function CreateTag($userId, $name, $description)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of de gebruiker een admin is
	if (!$user->admin)
	{
		return false;
	}
	//Kijk of de tag al bestaat
	if (TagNameExists($name))
	{
		return false;
	}
	//Add tag
	AddTagToDatabase($name, $description);
}

?>