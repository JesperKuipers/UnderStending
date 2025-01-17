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
	$currFile = basename($_SERVER["SCRIPT_FILENAME"], '.php');
	if(!isset($_SESSION["userID"]) && $currFile !== "login") {
		header("Location: login.php");
	}
	//print_r($_SESSION);
	
	if(isset($_SESSION["userID"])) {
		$userID = $_SESSION["userID"];
		$user = getAdministrator($userID);
		if($user) {
			$isAdmin = $user->admin;
		} else {
			$isAdmin = FALSE;
		}
	}	
	
	if(isset($_GET["language"])) {
		if ($_GET['language'] == 'en') {
			$_SESSION['language'] = 'en';
		}
		else if ($_GET['language'] == 'nl') {
			$_SESSION['language'] = 'nl';
		}
	}
	else if(!isset($_SESSION['language'])) {
		$_SESSION['language'] = 'nl';
	}
        
        if(isset($_GET["style"])) {
		if ($_GET['style'] == 'dark') {
			$_SESSION['style'] = 'dark';
		}
		else if ($_GET['style'] == 'light') {
			$_SESSION['style'] = 'light';
		}
	}
	else if(!isset($_SESSION['style'])) {
		$_SESSION['style'] = 'light';
	}
       
?>
<!DOCTYPE HTML>
<html lang="nl">
	<head>
		<meta charset="utf-8">
                <?php if ($_SESSION['style'] == "dark") {?>
                    <link rel="stylesheet" type="text/css" href="css/styleDark.css">
                <?php } else { ?>
                    <link rel="stylesheet" type="text/css" href="css/style.css">
                <?php } ?>

		<script src="js/script.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
            <?php if ($_SESSION['language'] == "en") {?>
		<div class="container">
			<div class="navbar">
				<a href="index.php">
					<img src="imgs/understending-logo.png" class="logo-image">
				</a>
				<div class="search-bar">
					<form method="get" action="search.php">
						<input type="text" name="q" placeholder="Search on UnderStending" class="search-bar-bar">
						<input type="image" src="imgs/search-icon.png" border="0" alt="Submit" class="search-icon"/>
					</form>
				</div>
				<div class="nav-menu">
					<ul>
						<li><a href="tags.php">Tags</a></li>
						<li><a href="playlists.php">Playlists</a></li>
						<!-- Show account link when logged in -->
						<?php if(!isset($_SESSION["userID"]) || isset($_GET["logout"])) { ?>
						<li><a href="login.php">Login</a></li>
						<!-- Show login link when not logged in -->
						<?php } else { ?>
						<li><a href="account.php">Account</a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="dropdown">
					<img src="imgs/hamburger-icon.png" width="80" height="80">
					<div class="dropdown-content">
						<a href="tags.php">Tags</a>
						<a href="playlists.php">Playlists</a>
						<!-- Show login link when not logged in -->
						<?php if(!isset($_SESSION["userID"]) || isset($_GET["logout"])) { ?>
						<a href="login.php">Login</a>
						<!-- Show account link when logged in -->
						<?php } else { ?>
						<a href="account.php">Account</a>
						<?php } ?>
					</div>
				</div>
			</div>
            <?php } else { ?>
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
						<?php if(!isset($_SESSION["userID"]) || isset($_GET["logout"])) { ?>
						<li><a href="login.php">Login</a></li>
						<!-- Show login link when not logged in -->
						<?php } else { ?>
						<li><a href="account.php">Account</a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="dropdown">
					<img src="imgs/hamburger-icon.png" width="80" height="80">
					<div class="dropdown-content">
						<a href="tags.php">Tags</a>
						<a href="playlists.php">Playlists</a>
						<!-- Show login link when not logged in -->
						<?php if(!isset($_SESSION["userID"]) || isset($_GET["logout"])) { ?>
						<a href="login.php">Login</a>
						<!-- Show account link when logged in -->
						<?php } else { ?>
						<a href="account.php">Account</a>
						<?php } ?>
					</div>
				</div>
			</div>
            <?php } ?>
