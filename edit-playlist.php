<?php include "includes/topinclude.php" ?>

<?php
	if(isset($_GET["id"])) {
		$playlistID = $_GET["id"];
		$playlist = GetPlaylist($playlistID);
	}
	else {
		header ('location: account.php');
	}
	
?>
<?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<div class="content-block">
			<h2>Modify Playlist</h2>
			<form method="post" action="manage-playlist.php" class="confirm-playlist" enctype="multipart/form-data">
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="name" placeholder="Name" value="<?php echo $playlist->name; ?>" />
					</div>
				</div>
				<input type="submit" class="button confirm" name="submit" value="Modify Playlist">
				<input type="hidden" name="playlistid" value="<?php echo $playlistID; ?>">
				<input type="hidden" name="edit" value="true">
				<a href="manage-playlist.php">Cancel</a>
			</form>
		</div>
	</div>
<?php } else { ?>
        <div class="content">
		<div class="content-block">
			<h2>Playlist bewerken</h2>
			<form method="post" action="manage-playlist.php" class="confirm-playlist" enctype="multipart/form-data">
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="name" placeholder="Naam" value="<?php echo $playlist->name; ?>" />
					</div>
				</div>
				<input type="submit" class="button confirm" name="submit" value="Playlist bewerken">
				<input type="hidden" name="playlistid" value="<?php echo $playlistID; ?>">
				<input type="hidden" name="edit" value="true">
				<a href="manage-playlist.php">Annuleren</a>
			</form>
		</div>
	</div>
<?php } ?>


<?php include "includes/bottominclude.php" ?>