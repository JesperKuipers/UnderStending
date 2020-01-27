<?php include "includes/topinclude.php" ?>

	<div class="content">
		<div class="content-block">
			<?php if ($_SESSION['language'] == "en") { ?>
			<h2>Add video to playlists</h2>
			<p><a href="account.php">&lt;&lt; Back to video</a></p>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-playlist.php">&#10010; Add Playlist</a></div>
			<?php } else { ?>
			<h2>Beheer playlists</h2>
			<p><a href="account.php">&lt;&lt; Terug naar video</a></p>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-playlist.php">&#10010; Playlist toevoegen </a></div>
			<?php } ?>
			
			
				<?php
				if($isAdmin) {
						$playlists = GetPlaylists(0, 500);
					} else {
						$playlists = GetPlaylistsByUser($userID);
					}
					
					if(!empty($playlists)) {
						foreach($playlists as $playlist) {
							echo "<div class='playlist-title'>
									<a href='delete-playlist.php?id=" . $playlist->playlistId . "' class='block-title-delete'>&#10006;</a> 
									<a href='edit-playlist.php?id=" . $playlist->playlistId . "' class='block-title-edit'>&#9998;</a> 
									<a href='playlist.php?id=" . $playlist->playlistId . "' class='block-title-video'>" . $playlist->name . "</a>
								</div>";
						}
					}
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>