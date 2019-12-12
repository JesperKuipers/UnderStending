<?php include "includes/topinclude.php" ?>

	<div class="content">
		<div class="blocks-container">
			<h2>Onze verschillende tags</h2>
			<div class="blocks">
				<!-- PHP Get all tags and loop through -->
				<?php for($i=0; $i<8; $i++) { ?>
				<!-- PHP Get tag ID of current tag -->
				<a href="tag.php?id=">
					<div class="block">
						<div class="block-naam tag-naam">
							<!-- PHP Get tag name of current video -->
							Tag naam
						</div>
						<!-- PHP Get tag thumbnail -->
						<img src="imgs/video-placeholder.jpg" />
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>