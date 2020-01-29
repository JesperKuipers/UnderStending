<?php include "includes/topinclude.php" ?>
<?php $tags = getTags(0, 50); ?>


	<div class="content">
		<div class="blocks-container">
			<?php if ($_SESSION['language'] == "en") {?>
			<h2>Our different tags</h2>
			<?php } else { ?>
			<h2>Onze verschillende tags</h2>
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
						echo "<p>There are nog tags yet</p>";
					} else {
						echo "<p>Er zijn nog geen tags</p>";
					}
				}?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>