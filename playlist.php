<?php include "includes/topinclude.php" ?>
<?php 
	if(getVideoID()) {
		$playlistID = getVideoID();
		$playlist = GetPlaylist($playlistID);
		$playlistFeatured = GetVideosByPlaylist($playlistID, 1);
		$playlistVideos = GetVideosByPlaylist($playlistID, 50);
		
		$featuredThumbnail = $playlistFeatured[0]->thumbnailId . "." . $playlistFeatured[0]->thumbnailExtension;
		$featuredUrl = $playlistFeatured[0]->playlistId;
	}
	else {
		header ('Location: index.php');
	}
?>

	<div class="content">
		<div class="video-container">
			<div id="video-placeholder">
				<!-- PHP Get playlists thumbnail -->
				<img src="imgs/video-placeholder.jpg" />
			</div>
			<div id="video-overlay" class="video-overlay-playlist">
				<div id="video-overlay-text">
					<h1>Playlist naam</h1>
					<a href="video.php?v=" class="video-bekijken-button">Beginnen met kijken</a>
				</div>
			</div>
		</div>
		<div class="blocks-container">
			<h2>De videos van deze playlist</h2>
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