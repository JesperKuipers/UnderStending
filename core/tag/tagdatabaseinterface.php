<?php

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

?>