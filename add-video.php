<?php include "includes/topinclude.php" ?>

<?php
	if (!empty($_POST["submit"]))
	{
		if(!empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_FILES["video"]) && !empty($_FILES["thumbnail"])) {
			$userid = $_SESSION["userID"];
			$title = $_POST["title"];
			$desc = $_POST["description"];
			$video = $_FILES["video"];
			$thumbnail = $_FILES["thumbnail"];
			
			$tags = $_POST["tags"];
			
			while (strpos($tags, ",,")) {
				$tags = str_replace(",,", ",", $tags);
			}	
			$tagarray = explode(",", $tags);
			
			foreach($tagarray as $index => $tag) {
				$tag = trim($tag, " ");
				$tagarray[$index] = $tag;
			}
			
			$videoID = createVideo($userid, $title, $desc, $video, $thumbnail);
			CreateAndAddTagsToVideo($userid, $videoID, $tagarray);
			header("location: manage-video.php");
		} else {
			$error = "Vul aub alle velden in.";
		}
	}
?>
<?php if ($_SESSION['language'] == "en") {?>
<div class="content">
	<div class="content-block">
		<h1>Upload video</h1>
		<?php if(isset($error)) { ?>
		<div class="form-error-block"><?php echo $error; ?></div>
		<?php } ?>
		<form method="post" action="add-video.php" enctype="multipart/form-data">
			<div class="form-block">
				<div class="form-block-field">
					<input type="text" name="title" placeholder="Title" />
				</div>
			</div>
			<div class="form-block">
				<div class="form-block-field">
					<textarea name="description" placeholder="Description" class="textarea"></textarea>
				</div>
			</div>
			<div class="form-block">
				<div class="form-block-field">
					<input type="text" name="tags" placeholder="Tags"></textarea>
				</div>
			</div>
			<div class="form-block">
				<div class="form-block-field">
					<label>Video</label><br>
					<input type="file" name="Video" >
				</div>
			</div>
			<div class="form-block">
				<div class="form-block-field">
					<label>Thumbnail</label><br>
					<input type="file" name="Thumbnail">
				</div>
			</div>
			<div class="form-block">
				<input type="submit" value="Upload Video" class="button" name="submit">
			</div>
		</form>
	</div>
</div>
<?php } else { ?>
<div class="content">
	<div class="content-block">
		<h1>Video uploaden</h1>
		<?php if(isset($error)) { ?>
		<div class="form-error-block"><?php echo $error; ?></div>
		<?php } ?>
		<form method="post" action="add-video.php" enctype="multipart/form-data">
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
					<input type="text" name="tags" placeholder="Tags"></textarea>
				</div>
			</div>
			<div class="form-block">
				<div class="form-block-field">
					<label>Video</label><br>
					<input type="file" name="video" >
				</div>
			</div>
			<div class="form-block">
				<div class="form-block-field">
					<label>Thumbnail</label><br>
					<input type="file" name="thumbnail">
				</div>
			</div>
			<div class="form-block">
				<input type="submit" value="Video uploaden" class="button" name="submit">
			</div>
		</form>
	</div>
</div>
<?php } ?>


<?php include "includes/bottominclude.php" ?>