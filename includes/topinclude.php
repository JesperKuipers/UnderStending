<?php
	//Try to include the functions.php
	try {
		include_once("core/functions.php");
	//Show errors when including fails
	} catch (\Throwable $e) {
		echo "<pre>" . print_r($e, TRUE) . "</pre>";
	}
        
        $conn = mysqli_connect("localhost", "root", "", "understendingdb");
        // And test the connection
        if(!$conn) {
            DIE("Could not connect: " . mysqli_error($conn));
        }
        session_start();
?>
<!DOCTYPE HTML>
<html lang="nl">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/script.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="navbar">
				<a href="index.php">
					<img src="imgs/understending-logo.png" class="logo-image">
				</a>
				<div class="search-bar">
					<form method="get" action="search.php">
						<input type="text" name="q" placeholder="Zoeken op UnderStending" class="search-bar-bar">
						<input type="image" src="imgs/search-icon.png" border="0" alt="Submit" class="search-icon"/>
					</form>
				</div>
				<div class="nav-menu">
					<ul>
						<li><a href="tags.php">Tags</a></li>
						<li><a href="playlists.php">Playlists</a></li>
						<!-- Show account link when logged in -->
						<?php if(isset($_SESSION["userID"])) { ?>
						<li><a href="account.php">Account</a></li>
						<!-- Show login link when not logged in -->
						<?php } else { ?>
						<li><a href="login.php">Login</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>