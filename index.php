<?php include "includes/topinclude.php" ?>
<?php $tags = getTags(0, 50); ?>

	<div class="content">
		<div class="video-container">			
			<div id="video-placeholder">
				<!-- PHP Get video thumbnail -->
				<img src="imgs/video-placeholder.jpg" />
			</div>
			<div class="home-video-overlay">
				<!-- PHP Get video ID -->
				<a href="video.php?v=">
					<img src="imgs/start-icon.png">
				</a>
			</div>
		</div>
		<div class="blocks-container">
		<h2>Onze verschillende tags<?php if (isset($_SESSION['name'])) { echo " voor u, " . $_SESSION['name']; } ?></h2>
			<div class="blocks">
				<?php foreach($tags as $tag) {
					echo "<a href='tag.php?id=" . $tag->tagId . "'>";
						echo "<div class='block'>";
							echo "<div class='block-naam tag-naam'>";
								echo $tag->name;
							echo "</div>";
							if(!$tag->thumbnailUrl) {
								echo "<img src='imgs/video-placeholder.jpg' />";
								
							} else {
								echo "<img src='" . $tag->thumbnailUrl . "' />";
							}
						echo "</div>";
					echo "</a>";
				} ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>