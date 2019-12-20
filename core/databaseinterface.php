<?php

//Geeft terug: boolean (0 = failed, 1 = success)
function Insert($query, $params, $types)
{	
	//Creeër connectie
	$conn = mysqli_connect('localhost', 'root', '', 'understendingdb');
	//Stop wanneer connectie faalt
	if (!$conn)
	{
		return false;
	}
	//Voorbereiding query
	if ($stmt = mysqli_prepare($conn, $query))
	{
		//Voeg parameters toe aan query
		if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
		{
			return false;
		}
		//Voer query uit
		if (!mysqli_stmt_execute($stmt))
		{
			return false;
		}
		//Sluit query
		mysqli_stmt_close($stmt);
		//Sluit connectie met db
		mysqli_close($conn);
		//Insert is gelukt geef true terug
		return true;
	}
	else
	{
		return false;
	}
}

//Geeft terug: query gelukt? rows[] niet gelukt? false
function Select($query, $params, $types)
{
	//Creeër connectie
	$conn = mysqli_connect('localhost', 'root', '', 'understendingdb');
	//Stop wanneer connectie faalt
	if (!$conn)
	{
		return false;
	}
	//Voorbereiding query
	if ($stmt = mysqli_prepare($conn, $query))
	{
		//Voeg parameters toe aan query
		if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
		{
			return false;
		}
		//Voer query uit
		if (!mysqli_stmt_execute($stmt))
		{
			return false;
		}
		//Haal het resultaat van de query op
		$result = mysqli_stmt_get_result($stmt);
		//Zet het resultaat om in een associatieve array
		$rows = mysqli_fetch_all($result, MYSQLI_NUM);
		//Sluit query
		mysqli_stmt_close($stmt);
		//Sluit connectie met db
		mysqli_close($conn);
		//Geef het resultaat terug aan de caller van deze functie
		return $rows;
	}
}

?>