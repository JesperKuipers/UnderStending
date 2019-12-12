<?php include "includes/topinclude.php" ?>

	<div class="content">
		<div class="blocks-container">
			<h2>Mijn playlists</h2>
			<div class="blocks">
				<!-- PHP Get all playlists and loop through -->
				<?php for($i=0; $i<8; $i++) { ?>
				<!-- PHP Get video ID of current playlist -->
				<a href="playlist.php?id=">
					<div class="block">
						<div class="block-naam playlist-naam">
							<!-- PHP Get playlist name of current video -->
							Playlist naam
						</div>
						<!-- PHP Get playlist thumbnail -->
						<img src="imgs/video-placeholder.jpg" />
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>