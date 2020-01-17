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
			$error = "Vul aub alle velden in.";
		}
	}
?>
<?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<div class="content-block">
			<h1>Add Playlist</h1>
			<?php if(isset($error)) { ?>
			<div class="form-error-block"><?php echo $error; ?></div>
			<?php } ?>
			<form method="post" action="add-playlist.php" enctype="multipart/form-data">
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="name" placeholder="Name" />
					</div>
				</div>
				<div class="form-block">
					<input type="submit" value="Add playlist" class="button" name="submit">
				</div>
			</form>
		</div>
	</div>
<?php } else { ?>
        <div class="content">
		<div class="content-block">
			<h1>Playlist toevoegen</h1>
			<?php if(isset($error)) { ?>
			<div class="form-error-block"><?php echo $error; ?></div>
			<?php } ?>
			<form method="post" action="add-playlist.php" enctype="multipart/form-data">
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="name" placeholder="Naam" />
					</div>
				</div>
				<div class="form-block">
					<input type="submit" value="Playlist toevoegen" class="button" name="submit">
				</div>
			</form>
		</div>
	</div>
<?php } ?>

<?php include "includes/bottominclude.php" ?>