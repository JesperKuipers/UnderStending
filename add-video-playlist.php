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
				<div class="block-manage-container">
			<?php } else { ?>
				<h2>Voeg video toe aan playlist</h2>
				<p><a href="video.php?id=<?php echo $videoID ?>">&lt;&lt; Terug naar video</a></p>
				<div class="block-manage-container">
			<?php }

				$playlists = GetNonAddedPlaylists($userID, $videoID);
				
				echo "<form action='video.php?id=" . $videoID . "' method='post'>";
					if(!empty($playlists)) {
						foreach($playlists as $playlist) {
							
							echo "<div class='playlist-title'>
								<label class='check-container'><input type='checkbox' name='playlistID[]' value='" . $playlist->playlistId . "'> <span class='checkmark'></span></label>
									<a href='playlist.php?id=" . $playlist->playlistId . "' class='block-title-video'>" . $playlist->name . "</a>
								</div>";
						}
					}
					echo "<input type='hidden' name='video-playlist' value='true'>";
					if ($_SESSION['language'] == "en") {
						echo "<input type='submit' value='Add video to these playlists' class='button add-video-to-playlist'>";
					} else {
						echo "<input type='submit' value='Voeg video toe aan deze playlists' class='button add-video-to-playlist'>";
					}
				echo "</form>";
			?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>