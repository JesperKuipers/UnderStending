<?php
// Auteur: Henk Bembom \\

function executeSQLPrepared ($Connection, $SQL)
	{
		//Prepare SQL statement\\
		if($stmt = mysqli_prepare($Connection, $SQL))
		{
			// Execute prepared SQL Statement\\
			if($stmt = mysqli_stmt_execute($stmt))
			{
				// Ken voor elke ? in de SQL statement een variable toe \\
				mysqli_stmt_bind_result($stmt, $GetSearchRequest);
				mysqli_stmt_store_result($stmt);
				if (mysqli_stmt_fetch($stmt))
				{
					echo "Werkt";
				}
				else
				{
					die(mysqli_error($Connection));
				}
			}
			else
			{
				die(mysqli_error($Connection));
			}
		}
		else
		{
			die(mysqli_error($Connection));
		}
	}

// Submit knop aanklikken om script te starten \\
if (isset(submitknop))
{
	
	// Zoekveld moet een 
	if(!empty($_GET['q']))
	{
		
		$Connection = mysqli_connect("localhost", "root", "")

		if($Connection === TRUE)
		{
			//Verbinding maken met server\\
			$DBName = 'understendingdb';
			//Selecteer Database\\
			if (mysqli_select_db($Connection, $DBName));
			{
				$GetSearchRequest = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
				$SQL1 = "SELECT * FROM 'tag' WHERE 'name' = ?";
				$SQL2 = "SELECT * FROM 'video' WHERE 'title' = ?";
				$SQL3 = "SELECT * FROM 'playlist' WHERE 'name' = ?";

				if (executeSQLPrepared($Connection, $SQL1));
				if (executeSQLPrepared ($Connection, $SQL2));
				if (executeSQLPrepared ($Connection, $SQL3));
			}
			else
			{
				die(mysqli_error($Connection));
			}
		}
		else
		{
			die(mysqli_connect_errno());
		}
	}
}
?>