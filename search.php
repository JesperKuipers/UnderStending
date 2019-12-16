
<!-- Display Top of the website -->
<?php
include('includes/topinclude.php');
?>

<?php
// Auteur: Henk Bembom \\
// Code optimization to prevent reptitiveness\\
function executeSQLPrepared ($Connection, $SQL, $keyword)
	{
		//Prepare SQL statement\\
		if($stmt = mysqli_prepare($Connection, $SQL))
			{
				$keyword = "%" . $keyword . "%";
				if (mysqli_stmt_bind_param($stmt, "s", $keyword))
				{	
					// Execute prepared SQL1 Statement\\
					if(mysqli_stmt_execute($stmt))
					{
						//Het toewijzen van kolommen aan variabelen\\
						mysqli_stmt_bind_result($stmt, $value1, $value2);
						// Bufferen van gegevens op het scherm\\
						mysqli_stmt_store_result($stmt);
						// Check of er gegevens gevonden zijn \\
						$rows = mysqli_stmt_num_rows($stmt);
						if ($rows !== 0)
						{
							mysqli_stmt_num_rows($stmt);
							while (mysqli_stmt_fetch($stmt))
							{
								echo $value1;
								echo $value2;
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
			$SQL1 = "SELECT videoID, title FROM video WHERE approved = 1 AND title LIKE ?;";
			$SQL2 = "SELECT tagID, name FROM tag WHERE name LIKE ?";
			$SQL3 = "SELECT playlistID, name FROM playlist WHERE name LIKE ?";

	 		//Prepare SQL1 statement\\
			executeSQLPrepared($Connection, $SQL1, $GetKeyword);
			executeSQLPrepared($Connection, $SQL2, $GetKeyword);
			executeSQLPrepared($Connection, $SQL3, $GetKeyword);
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
	mysqli_close($Connection);
?>

<?php
include('includes/bottominclude.php');
?>