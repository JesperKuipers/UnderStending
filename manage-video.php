<?php include "includes/topinclude.php" ?>

<?php if(isset($_POST["videoid"])) {
	$videoID = $_POST["videoid"];
	$userID = $_SESSION["userID"];
	RemoveVideo($videoID, $userID);
	$error = "Video verwijdert";
}

?>
	<div class="content">
		<div class="content-block">
			<?php if(isset($error)) { echo '<div class="form-confirm-block">' . $error . '</div>'; } ?>
			<h2>Manage videos</h2>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-video.php">&#10010; Video toevoegen </a></div>
				<!-- PHP get all videos -->
				<?php
					for($i=1; $i<8; $i++) {
						echo "<div class='block-title'>
								<a href='delete-video.php?id=" . $i . "' class='block-title-delete'>&#10006;</a> 
								<a href='edit-video.php?id=" . $i . "' class='block-title-edit'>&#9998;</a> 
								<a href='video.php?v=" . $i . "' class='block-title-video'>Naam van de video</a>
							</div>";
					} 
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>