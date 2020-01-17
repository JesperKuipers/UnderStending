<?php include('includes/topinclude.php'); ?>

<?php
	$query = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
	$results = Search($query);
?>
<?php if ($_SESSION['language'] == "en") {?>
	<div class="blocks-container">
		<h2>Results for "<?php echo $query; ?>"</h2>
		<div class="blocks">
			<?php 
			foreach($results as $result) {
				if(isset($result[0]->videoId)) {
					foreach($result as $video) {
						$videoID = $video->videoId;
						$title = $video->title;
						$thumbnail = $video->ThumbnailUrl();
						
						echo "<a href='video.php?v=" . $videoID . "'>";
							echo "<div class='block'>";
								echo "<div class='block-naam video-naam'>";
									echo $title;
								echo "</div>";
								echo "<img src='" . $thumbnail . "' />";
							echo "</div>";
						echo "</a>";
					}
				}
				else if(isset($result[0]->tagId)) {
					foreach($result as $tag) {
						$tagID = $tag->tagId;
						$name = $tag->name;
						$thumbnail = $tag->thumbnailId . "." . $tag->thumbnailExtension;
						
						echo "<a href='tag.php?v=" . $tagID . "'>";
							echo "<div class='block'>";
								echo "<div class='block-naam tag-naam'>";
									echo $name;
								echo "</div>";
								echo "<img src='imgs/thumbnails/" . $thumbnail . "' />";
							echo "</div>";
						echo "</a>";
					}
				}
				else if(isset($result[0]->playlistId)) {
					foreach($result as $playlist) {
						$playlistID = $playlist->playlistId;
						$name = $playlist->name;
						$thumbnail = $playlist->thumbnailId . "." . $playlist->thumbnailExtension;
						
						echo "<a href='playlist.php?v=" . $playlistID . "'>";
							echo "<div class='block'>";
								echo "<div class='block-naam playlist-naam'>";
									echo $name;
								echo "</div>";
								echo "<img src='imgs/thumbnails/" . $thumbnail . "' />";
							echo "</div>";
						echo "</a>";
					}
				}
			} 
			?>
		</div>
	</div>
<?php } else { ?>
        <div class="blocks-container">
		<h2>Resultaten voor "<?php echo $query; ?>"</h2>
		<div class="blocks">
			<?php 
			foreach($results as $result) {
				if(isset($result[0]->videoId)) {
					foreach($result as $video) {
						$videoID = $video->videoId;
						$title = $video->title;
						$thumbnail = $video->ThumbnailUrl();
						
						echo "<a href='video.php?v=" . $videoID . "'>";
							echo "<div class='block'>";
								echo "<div class='block-naam video-naam'>";
									echo $title;
								echo "</div>";
								echo "<img src='" . $thumbnail . "' />";
							echo "</div>";
						echo "</a>";
					}
				}
				else if(isset($result[0]->tagId)) {
					foreach($result as $tag) {
						$tagID = $tag->tagId;
						$name = $tag->name;
						$thumbnail = $tag->thumbnailId . "." . $tag->thumbnailExtension;
						
						echo "<a href='tag.php?v=" . $tagID . "'>";
							echo "<div class='block'>";
								echo "<div class='block-naam tag-naam'>";
									echo $name;
								echo "</div>";
								echo "<img src='imgs/thumbnails/" . $thumbnail . "' />";
							echo "</div>";
						echo "</a>";
					}
				}
				else if(isset($result[0]->playlistId)) {
					foreach($result as $playlist) {
						$playlistID = $playlist->playlistId;
						$name = $playlist->name;
						$thumbnail = $playlist->thumbnailId . "." . $playlist->thumbnailExtension;
						
						echo "<a href='playlist.php?v=" . $playlistID . "'>";
							echo "<div class='block'>";
								echo "<div class='block-naam playlist-naam'>";
									echo $name;
								echo "</div>";
								echo "<img src='imgs/thumbnails/" . $thumbnail . "' />";
							echo "</div>";
						echo "</a>";
					}
				}
			} 
			?>
		</div>
	</div>
<?php } ?>

<?php include('includes/bottominclude.php'); ?>