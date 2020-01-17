<?php include "includes/topinclude.php" ?>
<?php 
	$unapprovedAmount = GetNonApprovedVideosCount();
?>
    <?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<div class="content-block">
			<h1>Account</h1>
			<div class="account-block">
				<a href="manage-video.php" class="button">Manage Videos</a>
			</div>
			
			<?php if($isAdmin) { ?>
			<div class="account-block">
				<a href="manage-tag.php" class="button">Manage Tags</a>
			</div>
			<?php } ?>
			
			<div class="account-block">
				<a href="manage-playlist.php" class="button">Manage Playlists</a>
			</div>
			
			<?php if($isAdmin) { ?>
			<div class="account-block">
				<a href="manage-approvals.php" class="button">Approve Videos
					<?php if($unapprovedAmount > 0) { echo "<span class='approve-button-number'>". $unapprovedAmount . "</span>"; } ?>
				</a>
				
			</div>
			<?php } ?>
			
			<div class="account-block">
				<a href="logout.php" class="button">Log Out</a>
			</div>
		</div>
	</div>

    <?php } else { ?>
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
    <?php } ?>

<?php include "includes/bottominclude.php" ?>