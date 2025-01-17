<?php include "includes/topinclude.php" ?>

<?php 
	$userID = $_SESSION["userID"];
	
	if(!empty($_POST["submit"])) {
		if(isset($_POST["delete"])) {
			$tagID = $_POST["tagid"];
			RemoveTag($userID, $tagID);
			$confirmnl = "Tag verwijdert";
			$confirmen = "Tag deleted";
		} 
	}
?>

	<div class="content">
		<div class="content-block">
			<?php if ($_SESSION['language'] == "en") {?>
				<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirmen . '</div>'; } ?>
				<h2>Manage tags</h2>
				<p><a href="account.php">&lt;&lt; Back to account</a></p>
			<?php } else { ?>
				<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirmnl . '</div>'; } ?>
				<h2>Manage tags</h2>
				<p><a href="account.php">&lt;&lt; Terug naar account</a></p>
			<?php } ?>
			<div class="block-manage-container">
				<div class="block-add"><a href="add-tag.php">&#10010; Add Tag</a></div>
				<?php
					$tags = GetTags(0, 500);
					if(!empty($tags)) {
						foreach($tags as $tag) {
							echo "<div class='tag-title'>
									<a href='delete-tag.php?id=" . $tag->tagId . "' class='block-title-delete'>&#10006;</a> 
									<a href='tag.php?id=" . $tag->tagId . "' class='block-title-video'>" . $tag->name . "</a>
								</div>";
						}
					} else {
						if ($_SESSION['language'] == "en") {
							echo "<p>There are no tags</p>";
						} else {
							echo "<p>Er zijn geen tags</p>";
						}
					}
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>