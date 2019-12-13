<?php include "includes/topinclude.php" ?>
<?php //require "core/video/functions/create-video.php"; ?>

	<div class="content">
		<div class="content-block">
			<h1>Video uploaden</h1>        
			<form method="post" action="test.php" enctype="multipart/form-data">
				<div class="form-block">
					<div class="form-block-field">
						<input type="text" name="title" placeholder="Titel" />
					</div>
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<textarea name="description" placeholder="Beschrijving" class="textarea"></textarea>
					</div>
				</div>
				<div class="form-block">
					<div class="form-block-field">
						<input type="file" name="video">
					</div>
				</div>
				<div class="form-block">
					<input type="submit" value="Video uploaden" class="button">
				</div>
			</form>
		</div>
	</div>

<?php
	if (!empty($_POST))
	{
		$createVideo = new CreateVideo();
		$createVideo->Create(0, $_POST, $_FILES["video"]);
	}
?>

<?php include "includes/bottominclude.php" ?>