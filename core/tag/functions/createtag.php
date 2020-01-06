<?php

function CreateTag($userId, $name, $description)
{
	//Haal gebruiker op
	$user = GetUserById($userId);
	//Kijk of de tag al bestaat
	if (TagNameExists($name))
	{
		return false;
	}
	//Add tag
	AddTagToDatabase($name, $description);
}

?>