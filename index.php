<?php include "includes/topinclude.php" ?>
<?php $tags = getTags(0, 50); ?>

	<div class="content">
		<?php
		$currentVideo = getCurrentVideo($_SESSION["userID"]);
		if($currentVideo) {
			echo "<div class='video-container'>";		
				echo "<div id='video-placeholder'>";
					echo "<img src='" . $currentVideo->thumbnailUrl . "' />";
				echo "</div>";
				echo "<div class='home-video-overlay'>";
					echo "<a href='video.php?v=" . $currentVideo->videoId. "'>";
						echo "<img src='imgs/start-icon.png'>";
					echo "</a>";
				echo "</div>";
			echo "</div>";
		} ?>
		<div class="blocks-container">
		<?php if ($_SESSION['language'] == "en") {?>
		<h2>Our different tags <?php if (isset($_SESSION['name'])) { echo " for you, " . $_SESSION['name']; } ?></h2>
		<?php } else { ?>
		<h2>Onze verschillende tags<?php if (isset($_SESSION['name'])) { echo " voor u, " . $_SESSION['name']; } ?></h2>
		<?php } ?>
			<div class="blocks">
				<?php if(!empty($tags)) {
					foreach($tags as $tag) {
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
					}
				} else {
					if ($_SESSION['language'] == "en") {
						echo "<p>There are no tags yet</p>";
					} else {
						echo "<p>Er zijn nog geen tags</p>";
					}
				} ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>