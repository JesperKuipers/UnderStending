<?php include "includes/topinclude.php" ?>

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
			<h2>Onze verschillende tags</h2>
			<div class="blocks">
				<!-- PHP Get all videos en loop erdoorheen -->
				<?php for($i=0; $i<8; $i++) { ?>
				<!-- PHP Get video ID of current video -->
				<a href="tag.php?id=">
					<div class="block">
						<div class="block-naam tag-naam">
							<!-- PHP Get tag name of current video -->
							Tag naam
						</div>
						<!-- PHP Get video thumbnail -->
						<img src="imgs/video-placeholder.jpg" />
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>