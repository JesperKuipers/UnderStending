<?php include "includes/topinclude.php" ?>
<?php 
	if(getVideoID()) {
		$videoID = getVideoID();
		$video = GetVideo($videoID);
	}
	else {
		header ('Location: index.php');
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
					<button onclick="showVideo()" class="video-bekijken-button">Video bekijken</a>
				</div>
			</div>
			<div id="video-player">
				<video src="<?php echo $video->videoUrl; ?>"controls></video>
			</div>
		</div>
		<div class="content-block video-bottom">
			<div class="description">
				<?php echo $video->description; ?>
			</div>
			<span class="rating">
				<input id="rating5" type="radio" name="rating" value="5">
				<label for="rating5">5</label>
				<input id="rating4" type="radio" name="rating" value="4">
				<label for="rating4">4</label>
				<input id="rating3" type="radio" name="rating" value="3">
				<label for="rating3">3</label>
				<input id="rating2" type="radio" name="rating" value="2" checked>
				<label for="rating2">2</label>
				<input id="rating1" type="radio" name="rating" value="1">
				<label for="rating1">1</label>
			</span>
			<div class="clear"></div>
		</div>
		
		<div class="blocks-container">
			<h2>Relevante videos</h2>
			<div class="blocks">
				<!-- PHP Get all videos and loop through -->
				<?php for($i=0; $i<8; $i++) { ?>
				<!-- PHP Get video ID of current video -->
				<a href="video.php?id=">
					<div class="block">
						<div class="block-naam video-naam">
							<!-- PHP Get video name of current video -->
							Video naam
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