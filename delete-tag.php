<?php include "includes/topinclude.php" ?>

<?php
	if(isset($_GET["id"])) {
		$tagID = $_GET["id"];
		$tag = GetTag($tagID);
	}
	else {
		header ('location: account.php');
	}
?>
<?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<div class="content-block">
			<h2>Are you sure that you want to remove<i><?php echo $tag->name; ?></i>?</h2>
			<form method="post" action="manage-tag.php" class="confirm-video">
				<input type="submit" class="button confirm" name="submit" value="Remove Tag">
				<input type="hidden" name="tagid" value="<?php if(isset($_GET["id"])) { echo $_GET["id"]; } ?>">
				<input type="hidden" name="delete" value="true">
				<a href="manage-tag.php">Cancel</a>
			</form>
		</div>
	</div>
<?php } else { ?>
        <div class="content">
		<div class="content-block">
			<h2>Weet u zeker dat u <i><?php echo $tag->name; ?></i> wilt verwijderen</h2>
			<form method="post" action="manage-tag.php" class="confirm-video">
				<input type="submit" class="button confirm" name="submit" value="Verwijder de tag">
				<input type="hidden" name="tagid" value="<?php if(isset($_GET["id"])) { echo $_GET["id"]; } ?>">
				<input type="hidden" name="delete" value="true">
				<a href="manage-tag.php">Annuleren</a>
			</form>
		</div>
	</div>
<?php } ?>


<?php include "includes/bottominclude.php" ?>