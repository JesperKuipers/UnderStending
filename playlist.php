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
<?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<div class="video-container">
			<div id="video-placeholder">
				<img src="<?php echo $playlistVideos[0]->thumbnailUrl; ?> "/>
			</div>
			<div id="video-overlay" class="video-overlay-playlist">
				<div id="video-overlay-text">
					<h1><?php echo $playlist->name; ?></h1>
					<a href="video.php?v=<?php echo $playlistVideos[0]->videoId ?>" class="video-bekijken-button">Start watching</a>
				</div>
			</div>
		</div>
		<div class="blocks-container">
			<h2>Videos in the "<?php echo $playlist->name; ?>" playlist</h2>
			<div class="blocks">
				<?php foreach($playlistVideos as $playlistVideo) {
					echo "<a href='video.php?id=" . $playlistVideo->videoId . "'>";
						echo "<div class='block'>";
							echo "<div class='block-naam video-naam'>";
								echo $playlistVideo->title;
							echo "</div>";
							echo "<img src='" . $playlistVideo->thumbnailUrl . "' />";
						echo "</div>";
					echo "</a>";
				} ?>
			</div>
		</div>
	</div>
<?php } else { ?>
        <div class="content">
		<div class="video-container">
			<div id="video-placeholder">
				<img src="<?php echo $playlistVideos[0]->thumbnailUrl; ?> "/>
			</div>
			<div id="video-overlay" class="video-overlay-playlist">
				<div id="video-overlay-text">
					<h1><?php echo $playlist->name; ?></h1>
					<a href="video.php?v=<?php echo $playlistVideos[0]->videoId ?>" class="video-bekijken-button">Beginnen met kijken</a>
				</div>
			</div>
		</div>
		<div class="blocks-container">
			<h2>De video's in de "<?php echo $playlist->name; ?>" playlist</h2>
			<div class="blocks">
				<?php foreach($playlistVideos as $playlistVideo) {
					echo "<a href='video.php?id=" . $playlistVideo->videoId . "'>";
						echo "<div class='block'>";
							echo "<div class='block-naam video-naam'>";
								echo $playlistVideo->title;
							echo "</div>";
							echo "<img src='" . $playlistVideo->thumbnailUrl . "' />";
						echo "</div>";
					echo "</a>";
				} ?>
			</div>
		</div>
	</div>
<?php } ?>

<?php include "includes/bottominclude.php" ?>