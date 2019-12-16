
<!-- Display Top of the website -->
<?php
include('includes/topinclude.php');
?>

<?php
// Auteur: Henk Bembom \\
// Code optimization to prevent reptitiveness\\
function executeSQLPrepared ($Connection, $SQL)
	{
		//Prepare SQL statement\\
		if($stmt = mysqli_prepare($Connection, $SQL))
		{
			// Execute prepared SQL Statement\\
			if($stmt = mysqli_stmt_execute($stmt))
			{
				// Ken voor elke ? in de SQL statement een variable toe \\
				mysqli_stmt_bind_result($stmt, $GetKeyword);
				mysqli_stmt_store_result($stmt);

				if (mysqli_stmt_num_rows($stmt) !== 0)
				{
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
					echo "<p>No results have been found</p>";
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


// Search Bar Code\\

// Zoekveld moet ingevuld zijn \\

	$Connection = mysqli_connect("localhost", "root", "");

	if($Connection)
	{
		//Verbinding maken met server\\
		$GetKeyword = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
		$DBName = 'understendingdb';
		//Selecteer Database\\
		if (mysqli_select_db($Connection, $DBName))
		{
			$SQL1 = "SELECT videoID, title, approved FROM video WHERE approved = 1 AND title LIKE '%?%'";
			$SQL2 = "SELECT * FROM tag WHERE name LIKE '%?%'";
			$SQL3 = "SELECT playlistID, name FROM playlist WHERE name LIKE '%?%'";

	 		//Prepare SQL1 statement\\
			if($stmt = mysqli_prepare($Connection, $SQL1))
			{ 
				if (mysqli_stmt_bind_param($stmt, "s", $GetKeyword))
				{			
					// Execute prepared SQL1 Statement\\
					if(mysqli_stmt_execute($stmt))
					{
						//Het toewijzen van kolommen aan variabelen\\
						mysqli_stmt_bind_result($stmt, $VideoID, $Title, $Approved);
						// Bufferen van gegevens op het scherm\\
						mysqli_stmt_store_result($stmt);
						// Check of er gegevens gevonden zijn \\
						if (mysqli_stmt_num_rows($stmt) !== 0)
						{
							if (mysqli_stmt_fetch($stmt))
							{
								while (mysqli_stmt_fetch($stmt))
								{
									echo $VideoID;
									echo $Title; 
								}
							}
							else
							{
								die(mysqli_error($Connection));
							}	
						}
						else
						{
							echo "<p>No results have been found.</p>";
						}
					}
					else
					{
						die(mysqli_error($Connection));
					}
				}					
			}

			//Prepare SQL2 statement\\
			if($stmt = mysqli_prepare($Connection, $SQL2))
			{
				if (mysqli_stmt_bind_param($stmt, "s", $GetKeyword))
				{
					// Execute prepared SQL2 Statement\\
					if(mysqli_stmt_execute($stmt))
					{
						//Het toewijzen van kolommen aan variabelen\\
						mysqli_stmt_bind_result($stmt, $TagID, $Name, $Description);
						// Bufferen van gegevens op het scherm\\
						mysqli_stmt_store_result($stmt);
						// Check of er gegevens gevonden zijn \\
						if (mysqli_stmt_num_rows($stmt) !== 0)
						{
							while (mysqli_stmt_fetch($stmt))
							{
								echo $TagID; 
								echo $Name; 
								echo $Description;
							}
						}
						else
						{
							echo "<p>No results have been found.</p>";
						}
					}
					else
					{
						die(mysqli_error($Connection));
					}
				}
			}
			//Prepare SQL3 statement\\
			if($stmt = mysqli_prepare($Connection, $SQL3))
			{
				if (mysqli_stmt_bind_param($stmt, "s", $GetKeyword))
				{
					// Execute prepared SQL3 Statement\\
					if(mysqli_stmt_execute($stmt))
					{
						//Het toewijzen van kolommen aan variabelen\\
						mysqli_stmt_bind_result($stmt, $PlaylistID, $Name);
						// Bufferen van gegevens op het scherm\\
						mysqli_stmt_store_result($stmt);
						// Check of er gegevens gevonden zijn \\
						if (mysqli_stmt_num_rows($stmt) !== 0)
						{
							while(mysqli_stmt_fetch($stmt))
							{
								echo $PlaylistID;
								echo $Name;
							}
						}
						else
						{
							echo "<p>No results have been found.</p>";
						}
					}
					else
					{
						die(mysqli_error($Connection));
					}
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
	else
	{
		die(mysqli_error($Connection));
	} 
?>

<?php
include('includes/bottominclude.php');
?>