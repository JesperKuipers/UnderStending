<?php include "includes/topinclude.php" ?>

<?php 
	if (!empty($_POST["submit"]))
	{
		if(!empty($_POST["name"])) {
			$userid = $_SESSION["userID"];
			$name = $_POST["name"];
			
			createPlaylist($userid, $name);
			header("location: manage-playlist.php");
		} else {
			$errornl = "Vul aub alle velden in";
			$erroren = "Please fill in all the fields";
		}
	}
?>

	<div class="content">
		<div class="content-block">
			<?php if ($_SESSION['language'] == "en") {?>
				<h1>Add Playlist</h1>
				<?php if(isset($erroren)) { ?>
				<div class="form-error-block"><?php echo $erroren; ?></div>
				<?php } ?>
			<?php } else { ?>
				<h1>Playlist toevoegen</h1>
				<?php if(isset($errornl)) { ?>
				<div class="form-error-block"><?php echo $errornl; ?></div>
				<?php } ?>
			<?php } ?>
			
			<form method="post" action="add-playlist.php" enctype="multipart/form-data">
				<div class="form-block">
					<div class="form-block-field">
						<?php if ($_SESSION['language'] == "en") {?>
						<input type="text" name="name" placeholder="Name" />
						<?php } else { ?>
						<input type="text" name="name" placeholder="Naam" />
						<?php } ?>
					</div>
				</div>
				<div class="form-block">
					<?php if ($_SESSION['language'] == "en") {?>
					<input type="submit" value="Add playlist" class="button" name="submit">
					<?php } else { ?>
					<input type="submit" value="Playlist toevoegen" class="button" name="submit">
					<?php } ?>
				</div>
			</form>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>