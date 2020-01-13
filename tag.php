<?php include "includes/topinclude.php" ?>
<?php 
	if(getVideoID()) {
		$tagID = getVideoID();
		$tag = GetTag($tagID);
		$tagFeatured = GetVideosByTag($tagID, 1);
		$tagVideos = GetVideosByTag($tagID, 50);
		
		$featuredThumbnail = $tagFeatured[0]->thumbnailId . "." . $tagFeatured[0]->thumbnailExtension;
		$featuredUrl = $tagFeatured[0]->videoId;
	}
	else {
		header ('Location: index.php');
	}
?>

	<div class="content">
		<div class="video-container">
			<div id="video-placeholder">
				<img src="imgs/thumbnails/<?php echo $featuredThumbnail; ?> "/>
			</div>
			<div id="video-overlay" class="video-overlay-tag">
				<div id="video-overlay-text">
					<h1><?php echo $tag->name; ?></h1>
					<a href="video.php?v=<?php echo $featuredUrl; ?>" class="video-bekijken-button">Beginnen met kijken</a>
				</div>
			</div>
		</div>
		<div class="blocks-container">
			<h2>De "<?php echo $tag->name; ?>" video's</h2>
			<div class="blocks">
				<?php foreach($tagVideos as $tagVideo) {
					$videoUrl = $tagVideo->thumbnailId . "." . $tagVideo->thumbnailExtension;
					
					echo "<a href='video.php?id='" . $tagVideo->videoId . ">";
						echo "<div class='block'>";
							echo "<div class='block-naam video-naam'>";
								echo $tagVideo->title;
							echo "</div>";
							echo "<img src='imgs/thumbnails/" . $videoUrl . "' />";
						echo "</div>";
					echo "</a>";
				} ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>