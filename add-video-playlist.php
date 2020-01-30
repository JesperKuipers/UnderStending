<?php include "includes/topinclude.php" ?>

<?php
	$userID = $_SESSION["userID"];
	if(isset($_GET["id"])) {
		$videoID = $_GET["id"];
		$video = GetVideo($videoID);
	}
	else {
		header ('location: index.php');
	}
?>

	<div class="content">
		<div class="content-block">
			<?php if ($_SESSION['language'] == "en") { ?>
				<h2>Add video to playlists</h2>
				<p><a href="video.php?id=<?php echo $videoID ?>">&lt;&lt; Back to video</a></p>
			<?php } else { ?>
				<h2>Voeg video toe aan playlist</h2>
				<p><a href="video.php?id=<?php echo $videoID ?>">&lt;&lt; Terug naar video</a></p>
			<?php }

				$playlists = GetNonAddedPlaylists($userID, $videoID);
				
				echo "<form action='manage-playlist.php?id=" . $videoID . "' method='post'>";
					if(!empty($playlists)) {
						foreach($playlists as $playlist) {
							
							echo "<div class='playlist-title'>
								<label class='check-container'><input type='checkbox' name='playlistID[]' value='" . $playlist->playlistId . "'> <span class='checkmark'></span></label>
									<a href='playlist.php?id=" . $playlist->playlistId . "' class='block-title-video button'>" . $playlist->name . "</a>
								</div>";
						}
					}
					echo "<input type='hidden' name='video-playlist' value='true'>";
					if ($_SESSION['language'] == "en") {
						echo "<input type='submit' name='submit' value='Add video to these playlists' class='button add-video-to-playlist confirm'>";
						echo "<a href='manage-playlist.php'>Cancel</a>";
					} else {
						echo "<input type='submit' name='submit' value='Voeg video toe aan deze playlists' class='button add-video-to-playlist confirm'>";
						echo "<a href='manage-playlist.php'>Annuleren</a>";
					}
				echo "</form>";
			?>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>