<?php include "includes/topinclude.php" ?>

<?php
	if(isset($_GET["id"])) {
		$videoID = $_GET["id"];
		$video = GetVideo($videoID);
	}
	else {
		header ('location: account.php');
	}
?>

	<div class="content">
		<div class="content-block">
			<h2>Weet u zeker dat u deze video wilt verwijderen</h2>
			<form method="post" action="manage-video.php" class="confirm-video">
				<div class="block">
					<div class="block-naam video-naam">
						<?php echo $video->title; ?>
					</div>
					<img src="<?php echo $video->thumbnailUrl; ?>" />
				</div>
				<input type="submit" class="button confirm" name="submit" value="Verwijder de video">
				<input type="hidden" name="videoid" value="<?php if(isset($_GET["id"])) { echo $_GET["id"]; } ?>">
				<input type="hidden" name="delete" value="true">
				<a href="manage-video.php">Annuleren</a>
			</form>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>