<?php include "includes/topinclude.php" ?>

	<div class="content">
		<div class="video-container">
			<div class="video-placeholder">
				<img src="imgs/video-placeholder.jpg" />
			</div>
			<div class="video-overlay video-overlay-playlist">
				<div class="video-overlay-text">
					<h1>Playlist naam</h1>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.</p>
					<a href="#" class="video-bekijken-button">Beginnen met kijken</a>
				</div>
			</div>
		</div>
		<div class="blocks-container">
			<h2>De videos van deze playlist</h2>
			<div class="blocks">
				<!-- Loop door de uitgelichte tags -->
				<?php for($i=0; $i<8; $i++) { ?>
				<a href="video.php?id="><!-- Link naar de tag -->
					<div class="block">
						<div class="block-naam video-naam">
							Video naam
						</div>
						<img src="imgs/video-placeholder.jpg" />
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>