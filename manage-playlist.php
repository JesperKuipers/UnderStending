<?php include "includes/topinclude.php" ?>

<?php 
	$userID = $_SESSION["userID"];
	
	if(!empty($_POST["submit"])) {
		if(isset($_POST["delete"])) {
			$playlistID = $_POST["playlistid"];
			RemovePlaylist($playlistID);
			$confirmnl = "Playlist verwijdert";
			$confirmen = "Playlist deleted";
		} 
		elseif(isset($_POST["edit"])) {
			$playlistID = $_POST["playlistid"];
			if(!empty($_POST["name"])) {
				$name = $_POST["name"];
				$confirmnl = "Playlist bijgewerkt";
				$confirmen = "Playlist updated";
				UpdatePlaylist($playlistID, $name);
			} else {
				header("location: edit-playlist.php?id=$playlistID");
			}
		}
	}
?>

	<div class="content">
		<div class="content-block">
			<?php if ($_SESSION['language'] == "en") {?>
				<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirmen . '</div>'; } ?>
				<h2>Manage playlists</h2>
				<p><a href="account.php">&lt;&lt; Back to account</a></p>
				<div class="block-manage-container">
					<div class="block-add"><a href="add-playlist.php">&#10010; Add Playlist</a></div>
			<?php } else { ?>
				<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirmnl . '</div>'; } ?>
				<h2>Beheer playlists</h2>
				<p><a href="account.php">&lt;&lt; Terug naar account</a></p>
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