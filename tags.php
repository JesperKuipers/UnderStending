<?php include "includes/topinclude.php" ?>
<?php $tags = getTags(0, 50); ?>
<?php if ($_SESSION['language'] == "en") {?>

	<div class="content">
		<div class="blocks-container">
			<h2>Our different tags</h2>
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
		<div class="blocks-container">
			<h2>Onze verschillende tags</h2>
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