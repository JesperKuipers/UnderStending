<?php include "includes/topinclude.php" ?>
<?php 
	$user = getAdministrator($_SESSION["userID"]);
	$isAdmin = $user->admin;
	$unapprovedAmount = GetNonApprovedVideosCount();
?>

	<div class="content">
		<div class="content-block">
			<h1>Account</h1>
			<div class="account-block">
				<a href="manage-video.php" class="button">Videos beheren</a>
			</div>
			
			<?php if($isAdmin) { ?>
			<div class="account-block">
				<a href="manage-tag.php" class="button">Tags beheren</a>
			</div>
			<?php } ?>
			
			<div class="account-block">
				<a href="manage-playlist.php" class="button">Playlists beheren</a>
			</div>
			
			<?php if($isAdmin) { ?>
			<div class="account-block">
				<a href="manage-approvals.php" class="button">Videos goedkeuren
					<?php if($unapprovedAmount > 0) { echo "<span class='approve-button-number'>". $unapprovedAmount . "</span>"; } ?>
				</a>
				
			</div>
			<?php } ?>
			
			<div class="account-block">
				<a href="logout.php" class="button">Uitloggen</a>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>