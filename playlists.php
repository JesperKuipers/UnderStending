<?php include "includes/topinclude.php" ?>

	<div class="content">
		<div class="blocks-container">
			<h2>Mijn playlists</h2>
			<div class="blocks">
				<!-- Loop door de uitgelichte tags -->
				<?php for($i=0; $i<8; $i++) { ?>
				<a href="playlist.php?id="><!-- Link naar de tag -->
					<div class="block">
						<div class="block-naam playlist-naam">
							Playlist naam
						</div>
						<img src="imgs/video-placeholder.jpg" />
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>