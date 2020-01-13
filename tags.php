<?php include "includes/topinclude.php" ?>
<?php $tags = getTags(0, 50); ?>

	<div class="content">
		<div class="blocks-container">
			<h2>Onze verschillende tags</h2>
			<div class="blocks">
				<?php var_dump($tags); foreach($tags as $tag) {
					echo "<a href='tag.php?id=" . $tag->tagId . "'>";
						echo "<div class='block'>";
							echo "<div class='block-naam tag-naam'>";
								echo $tag->name;
							echo "</div>";
							echo "<img src='" . $tag->thumbnailUrl . "' />";
						echo "</div>";
					echo "</a>";
				} ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>