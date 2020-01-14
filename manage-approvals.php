<?php include "includes/topinclude.php" ?>

<?php 
	$userID = $_SESSION["userID"];
	
	if(!empty($_POST["submit"])) {
		if(isset($_POST["approve"])) {
			$videoID = $_POST["videoid"];
			ApproveVideo($userID, $videoID);
			$confirm = "Video goedgekeurt";
		} 
	}
?>
	<div class="content">
		<div class="content-block">
			<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirm . '</div>'; } ?>
			<h2>Beheer videos</h2>
			<p><a href="account.php">&lt;&lt; Terug naar account</a></p>
			<div class="block-manage-container">
				<?php
					$videos = GetVideos(500);
					if(!empty($videos)) {
						foreach($videos as $video) {
							echo "<div class='block-title'>
									<a href='approve-video.php?id=" . $video->videoId . "' class='block-title-approve'>&#x2714;</a> 
									<a href='video.php?v=" . $video->videoId . "' class='block-title-video'>" . $video->title . "</a>
								</div>";
						}
					}
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>