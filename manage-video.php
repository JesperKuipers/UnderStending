<?php include "includes/topinclude.php" ?>

	<div class="content">
		<div class="content-block">
			<h2>Manage videos</h2>
			<div class="video-manage-container">
				<div class="video-add"><a href="add-video.php">&#10010; Video toevoegen </a></div>
				<!-- PHP get all videos -->
				<?php
					for($i=1; $i<8; $i++) {
						echo "<div class='video-title'>
								<a href='delete-video.php?id=" . $i . "' class='video-title-delete'>&#10006;</a> 
								<a href='edit-video.php?id=" . $i . "' class='video-title-edit'>&#9998;</a> 
								<a href='video.php?id=" . $i . "' class='video-title-video'>Naam van de video</a>
							</div>";
					} 
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>