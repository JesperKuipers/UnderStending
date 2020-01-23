<?php include "includes/topinclude.php" ?>
<?php $tags = getTags(0, 50); ?>
<?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<?php
		$currentVideo = getCurrentVideo($_SESSION["userID"]);
		if($currentVideo) {
			echo "<div class='video-container'>";		
				echo "<div id='video-placeholder'>";
					echo "<img src='" . $currentVideo->thumbnailUrl . "' />";
				echo "</div>";
				echo "<div class='home-video-overlay'>";
					echo "<a href='video.php?v=" . $currentVideo->videoId . "&t=" . $currentVideo->timestamp . "'>";
						echo "<img src='imgs/start-icon.png'>";
					echo "</a>";
				echo "</div>";
			echo "</div>";
		} ?>
		<div class="blocks-container">
		<h2>Our Different tags <?php if (isset($_SESSION['name'])) { echo " for you, " . $_SESSION['name']; } ?></h2>
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
<?php } else { ?>
        <div class="content">
		<?php 
		$currentVideo = getCurrentVideo($_SESSION["userID"]);
		if($currentVideo) {
			echo "<div class='video-container'>";		
				echo "<div id='video-placeholder'>";
					echo "<img src='" . $currentVideo->thumbnailUrl . "' />";
				echo "</div>";
				echo "<div class='home-video-overlay'>";
					echo "<a href='video.php?v=" . $currentVideo->videoId . "&t=" . $currentVideo->timestamp . "'>";
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
<?php } ?>



<?php include "includes/bottominclude.php" ?>