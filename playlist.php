<?php include "includes/topinclude.php" ?>
<?php 
	if(getVideoID()) {
		$playlistID = getVideoID();
		$playlist = GetPlaylist($playlistID);
		$playlistVideos = GetVideosByPlaylist($playlistID, 50);
	}
	else {
		header ('Location: index.php');
	}
?>

	<div class="content">
		<div class="video-container">
			<div id="video-placeholder">
				<img src="<?php echo $playlistVideos[0]->thumbnailUrl; ?> "/>
			</div>
			<div id="video-overlay" class="video-overlay-playlist">
				<div id="video-overlay-text">
					<h1><?php echo $playlist->name; ?></h1>
					<?php if(!empty($playlistVideos)) {
						if ($_SESSION['language'] == "en") {
							echo "<a href='video.php?v='" . $playlistVideos[0]->videoId . "' class='video-bekijken-button'>Start watching</a>";
						} else { 
							echo "<a href='video.php?v='" . $playlistVideos[0]->videoId . "' class='video-bekijken-button'>Beginnen met kijken</a>";
						}
					} ?>
					
				</div>
			</div>
		</div>
		<div class="blocks-container">
			<?php if ($_SESSION['language'] == "en") {?>
			<h2>Videos in the "<?php echo $playlist->name; ?>" playlist</h2>
			<?php } else { ?>
			<h2>Video's in de "<?php echo $playlist->name; ?>" playlist</h2>
			<?php } ?>
			<div class="blocks">
				<?php 
				if(!empty($playlistVideos)) {
					foreach($playlistVideos as $playlistVideo) {
						echo "<a href='video.php?id=" . $playlistVideo->videoId . "'>";
							echo "<div class='block'>";
								echo "<div class='block-naam video-naam'>";
									echo $playlistVideo->title;
								echo "</div>";
								echo "<img src='" . $playlistVideo->thumbnailUrl . "' />";
							echo "</div>";
						echo "</a>";
					}
				} else {
					if ($_SESSION['language'] == "en") {
						echo "<p>There are no videos added to this playlist yet</p>";
					} else {
						echo "<p>Er zijn nog geen videos toegevoegd aan deze playlist</p>";
					}
				} ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>