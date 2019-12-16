<?php include "includes/topinclude.php" ?>

<?php 

if(isset($_POST['tag']))
{
	if(!empty($_POST['tag']))
	{
		$Connection = mysqli_client_encoding("localhost", "root", "");

		if($Connection === TRUE)
		{
			$DBName = "understendingdb";

			if (mysqli_select_db($DBName))
			{
				$getTag = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_SPECIAL_CHARS);
				$SQL = "INSERT INTO tag (name) VALUES (?)";

				if($stmt = mysqli_prepare($Connection, $SQL))
				{
					if (mysqli_stmt_bind_param($stmt, "s", $getTag))
					{
						if(mysqli_stmt_execute($stmt))
						{
							echo "Tag toegevoegd";
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
	else
	{
		echo "Alle velden dienen ingevuld te worden.";
	}
}

?>


<?php include "includes/bottominclude.php" ?>