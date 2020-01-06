<?php include "includes/topinclude.php" ?>

	<div class="content">
		<div class="content-block">
			<h2>Manage videos</h2>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-tag.php">&#10010; Tag toevoegen </a></div>
				<!-- PHP get all videos -->
				<?php
					for($i=1; $i<8; $i++) {
						echo "<div class='video-title'>
								<a href='delete-tag.php?id=" . $i . "' class='block-title-delete'>&#10006;</a> 
								<a href='edit-tag.php?id=" . $i . "' class='block-title-edit'>&#9998;</a> 
								<a href='tag.php?id=" . $i . "' class='block-title-video'>Naam van de tag</a>
							</div>";
					} 
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>