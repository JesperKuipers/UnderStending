<?php include "includes/topinclude.php" ?>

	<div class="content">
		<div class="video-container">
			<div id="video-placeholder">
				<!-- PHP Get playlists thumbnail -->
				<img src="imgs/video-placeholder.jpg" />
			</div>
			<div id="video-overlay" class="video-overlay-playlist">
				<div id="video-overlay-text">
					<!--PHP Playlist name -->
					<h1>Playlist naam</h1>
					<!--PHP Playlist description -->
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.</p>
					<!-- PHP link to first video -->
					<a href="video.php?v=" class="video-bekijken-button">Beginnen met kijken</a>
				</div>
			</div>
		</div>
		<div class="blocks-container">
			<h2>De videos van deze playlist</h2>
			<div class="blocks">
				<!-- PHP Get all videos and loop through -->
				<?php for($i=0; $i<8; $i++) { ?>
				<!-- PHP Get video ID of current video -->
				<a href="video.php?id=">
					<div class="block">
						<div class="block-naam video-naam">
							<!-- PHP Get video name of current video -->
							Video naam
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