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

	<div class="content">
		<div class="content-block">
			<h2>Weet u zeker dat u <i><?php echo $playlist->name; ?></i> wilt verwijderen</h2>
			<form method="post" action="manage-playlist.php" class="confirm-video">
						<?php  ?>
				<input type="submit" class="button confirm" name="submit" value="Verwijder de playlist">
				<input type="hidden" name="playlistid" value="<?php if(isset($_GET["id"])) { echo $_GET["id"]; } ?>">
				<input type="hidden" name="delete" value="true">
				<a href="manage-playlist.php">Annuleren</a>
			</form>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>