<?php include "includes/topinclude.php" ?>
<?php $tags = getTags(0, 50); ?>

	<div class="content">
		<?php 
		if(getCurrentVideo($_SESSION["userID"])) { 
			$currentVideo = getCurrentVideo($_SESSION["userID"]);
			$videoID = $currentVideo->videoId;
			$video = getVideo($videoID);
			echo "<div class='video-container'>";		
				echo "<div id='video-placeholder'>";
					echo "<img src='" . $video->thumbnailUrl . "' />";
				echo "</div>";
				echo "<div class='home-video-overlay'>";
					echo "<a href='video.php?v='" . $video->videoId . ">";
						echo "<img src='imgs/start-icon.png'>";
					echo "</a>";
				echo "</div>";
			echo "</div>";
		} ?>
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