<?php include "includes/topinclude.php" ?>

<?php
	if(isset($_GET["id"])) {
		$videoID = $_GET["id"];
		$video = GetVideo($videoID);
		$videotags = getTagsByVideo($videoID);
		$tagnames = "";
		foreach($videotags as $videotag) {
			$tagnames.=$videotag->name . ",";
		}
		$tagnames = trim($tagnames, ",");
	}
	else {
		header ('location: account.php');
	}
	
?>

<?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<div class="content-block">
			<h2>Modify video</h2>
			<form method="post" action="manage-video.php" class="confirm-video" enctype="multipart/form-data">
				<div class="block">
					<div class="block-naam video-naam">
						<?php echo $video->title; ?>
					</div>
					<img src="<?php echo $video->thumbnailUrl; ?>" />
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="title" placeholder="Title" value="<?php echo $video->title; ?>" />
					</div>
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<textarea name="description" placeholder="Description" class="textarea"><?php echo $video->description; ?></textarea>
					</div>
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="tags" placeholder="Tags" value="<?php echo $tagnames; ?>"></textarea>
					</div>
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<label>Thumbnail</label><br>
						<input type="file" name="thumbnail">
					</div>
				</div>
				<input type="submit" class="button confirm" name="submit" value="Modify Video">
				<input type="hidden" name="videoid" value="<?php if(isset($_GET["id"])) { echo $_GET["id"]; } ?>">
				<input type="hidden" name="edit" value="true">
				<a href="manage-video.php">Cancel</a>
			</form>
		</div>
	</div>
<?php } else { ?>
	<div class="content">
		<div class="content-block">
			<h2>Video bewerken</h2>
			<form method="post" action="manage-video.php" class="confirm-video" enctype="multipart/form-data">
				<div class="block">
					<div class="block-naam video-naam">
						<?php echo $video->title; ?>
					</div>
					<img src="<?php echo $video->thumbnailUrl; ?>" />
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="title" placeholder="Titel" value="<?php echo $video->title; ?>" />
					</div>
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<textarea name="description" placeholder="Beschrijving" class="textarea"><?php echo $video->description; ?></textarea>
					</div>
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="tags" placeholder="Tags" value="<?php echo $tagnames; ?>"></textarea>
					</div>
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<label>Thumbnail</label><br>
						<input type="file" name="thumbnail">
					</div>
				</div>
				<input type="hidden" name="videoid" value="<?php if(isset($_GET["id"])) { echo $_GET["id"]; } ?>">
				<input type="hidden" name="edit" value="true">
				<input type="submit" class="button confirm" name="submit" value="Video bewerken">				
				<a href="manage-video.php">Annuleren</a>
			</form>
		</div>
	</div>
<?php } ?>

<?php include "includes/bottominclude.php" ?>