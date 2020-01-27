<?php include "includes/topinclude.php" ?>
<?php 
	if(getVideoID()) {
		$videoID = getVideoID();
		$video = GetVideo($videoID);
	} else {
		header ('Location: index.php');
	}
	
	if(isset($_GET["t"])) {
		$timestamp = $_GET["t"];
	} else {
		$timestamp = 0;
	}
?>

	<div class="content">
		<div class="video-container">
			<div id="video-placeholder">
				<img src="<?php echo $video->thumbnailUrl; ?>" />
			</div>
			<div id="video-overlay" class="video-overlay-video">
				<div id="video-overlay-text">
					<h1><?php echo $video->title; ?></h1>
					<p><?php echo $video->description; ?></p>
					<?php if ($_SESSION['language'] == "en") { ?>
					<button onclick="showVideo()" class="video-bekijken-button">Watch video</button>
					<?php } else { ?>
					<button onclick="showVideo()" class="video-bekijken-button">Video bekijken</button>
					<?php } ?>
				</div>
			</div>
			<div id="video-player">
				<?php echo "<video 	onloadstart='setTimestamp(" . $timestamp . ")' 
									onpause='saveTimestamp(" . $videoID . ", " . $userID . ", 0)' 
									onended='saveTimestamp(" . $videoID . ", " . $userID . ", 1)' id='video' controls>
										<source src='" . $video->videoUrl . "' type='video/mp4'>
										Your browser does not support HTML5 video.
							</video>"; ?>
			</div>
		</div>
		<div class="content-block video-bottom">
			<?php 
			if($video->approved == 0 && $isAdmin) {
				echo "<div class='approve-video-container'><a href='approve-video.php?id=" . $video->videoId . "' class='approve-video-button'>&#x2714; Approve Video</a></div>";	
			} 
			echo "<div><a href='add-video-playlist.php?id=" . $video->videoId . "' class='add-video-button'>Add video to playlist</a><div class='clear'></div></div>";
			?>
		
			<div class="description">
				<?php echo $video->description; ?>
			</div>
			
			<span class="rating">
				<?php for($i=5;$i>=1;$i--) {
					$checked = "";
					if($i == $video->rating) { 
						$checked = "checked"; 
					}
					echo "<input id='rating" . $i . "' type='radio' name='rating' value='" . $i . "' onclick='uploadRating(this.value, " . $videoID . ", " . $userID . ")' " . $checked  . ">";
					echo "<label for='rating" . $i . "'>" . $i . "</label>";
				} ?>
			</span>
			<div class="clear"></div>
			<div id="output"></div>
		</div>
		
		<div class="blocks-container">
			<?php if ($_SESSION['language'] == "en") { ?>
			<h2>Relevant videos</h2>
			<?php } else { ?>
			<h2>Relevante video's</h2>
			<?php } ?>
			<div class="blocks">
				<!-- PHP Get all videos and loop through -->
				<?php for($i=0; $i<8; $i++) { ?>
				<!-- PHP Get video ID of current video -->
				<a href="video.php?id=">
					<div class="block">
						<div class="block-naam video-naam">
							<!-- PHP Get video name of current video -->
							Video name
						</div>
						<!-- PHP Get video thumbnail -->
						<img src="imgs/video-placeholder.jpg" />
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>