<?php include "includes/topinclude.php" ?>
<?php $playlists = getPlaylists(0, 50); ?>

	<div class="content">
		<div class="blocks-container">
			<h2>Mijn playlists</h2>
			<div class="blocks">
				<?php foreach($playlists as $playlist) {
					echo "<a href='playlist.php?id=" . $playlist->playlistId . "'>";
						echo "<div class='block'>";
							echo "<div class='block-naam tag-naam'>";
								echo $playlist->name;
							echo "</div>";
							if(!$playlist->thumbnailUrl) {
								echo "<img src='imgs/video-placeholder.jpg' />";
								
							} else {
								echo "<img src='" . $playlist->thumbnailUrl . "' />";
							}
						echo "</div>";
					echo "</a>";
				} ?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>