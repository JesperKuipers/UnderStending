<?php include "includes/topinclude.php" ?>

<?php 
	$userID = $_SESSION["userID"];
	
	if(!empty($_POST["submit"])) {
		if(isset($_POST["delete"])) {
			$videoID = $_POST["videoid"];
			RemoveVideo($videoID, $userID);
			$confirm = "Video verwijdert";
		} 
		elseif(isset($_POST["edit"])) {
			$videoID = $_POST["videoid"];
			$title = $_POST["title"];
			$description = $_POST["description"];
			if(empty($_FILES["thumbnail"])) {
				$thumbnail = NULL;
			} else {
				$thumbnail = $_FILES["thumbnail"];				
			}
			UpdateVideo($videoID, $userID, $title, $description, $thumbnail);
			$confirm = "Video bijgewerkt";
		}
	}
?>
	<div class="content">
		<div class="content-block">
			<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirm . '</div>'; } ?>
			<h2>Manage videos</h2>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-video.php">&#10010; Video toevoegen </a></div>
				<?php
					$videos = GetVideos(500);
					if(!empty($videos)) {
						foreach($videos as $video) {
							echo "<div class='block-title'>
									<a href='delete-video.php?id=" . $video->videoId . "' class='block-title-delete'>&#10006;</a> 
									<a href='edit-video.php?id=" . $video->videoId . "' class='block-title-edit'>&#9998;</a> 
									<a href='video.php?v=" . $video->videoId . "' class='block-title-video'>" . $video->title . "</a>
								</div>";
						}
					}
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>