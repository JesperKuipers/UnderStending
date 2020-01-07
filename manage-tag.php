<?php include "includes/topinclude.php" ?>

<?php 
	$userID = $_SESSION["userID"];
	
	
	if(!empty($_POST["submit"])) {
		if(isset($_POST["delete"])) {
			$tagID = $_POST["tagid"];
			RemoveTag($tagID, $userID);
			$confirm = "Tag verwijdert";
		} 
	}
?>
	<div class="content">
		<div class="content-block">
			<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirm . '</div>'; } ?>
			<h2>Manage tags</h2>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-tag.php">&#10010; Tag toevoegen </a></div>
				<?php
					//$tags = GetTags(500);
					if(!empty($tags)) {
						foreach($tags as $tag) {
							echo "<div class='tag-title'>
									<a href='delete-tag.php?id=" . $tag->tagId . "' class='block-title-delete'>&#10006;</a> 
									<a href='tag.php?id=" . $tag->tagId . "' class='block-title-video'>" . $tag->name . "</a>
								</div>";
						}
					}
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>