<?php include "includes/topinclude.php" ?>

<?php 
	$userID = $_SESSION["userID"];
	
	if(!empty($_POST["submit"])) {
		if(isset($_POST["approve"])) {
			$videoID = $_POST["videoid"];
			ApproveVideo($userID, $videoID);
			$confirmnl = "Video goedgekeurt";
			$confirmen = "Video approved";
		} 
	}
?>

	<div class="content">
		<div class="content-block">
			<?php if ($_SESSION['language'] == "en") {?>
				<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirmen . '</div>'; } ?>
				<h2>Manage approvals</h2>
				<p><a href="account.php">&lt;&lt; Back to account</a></p>
			<?php } else { ?>
				<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirmnl . '</div>'; } ?>
				<h2>Beheer goedkeuringen</h2>
				<p><a href="account.php">&lt;&lt; Terug naar account</a></p>
			<?php } ?>
			<div class="block-manage-container">
				<?php
					$videos = GetNonApprovedVideos(0,500);
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