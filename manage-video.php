<?php include "includes/topinclude.php" ?>

<?php 	
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
<?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<div class="content-block">
			<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirm . '</div>'; } ?>
			<h2>Manage videos</h2>
			<p><a href="account.php">&lt;&lt; Back to account</a></p>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-video.php">&#10010; Add Video</a></div>
				<?php
					if($isAdmin) {
						$videos = GetVideos(500);
					} else {
						$videos = GetVideosByUser($userID);
					}
					
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
<?php } else { ?>
        <div class="content">
		<div class="content-block">
			<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirm . '</div>'; } ?>
			<h2>Beheer videos</h2>
			<p><a href="account.php">&lt;&lt; Terug naar account</a></p>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-video.php">&#10010; Video toevoegen </a></div>
				<?php
					if($isAdmin) {
						$videos = GetVideos(500);
					} else {
						$videos = GetVideosByUser($userID);
					}
					
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
<?php } ?>


<?php include "includes/bottominclude.php" ?>