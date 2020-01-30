<?php include "includes/topinclude.php" ?>

<?php 	
	if(!empty($_POST["submit"])) {
		$videoID = $_POST["videoid"];
		if(isset($_POST["delete"])) {
			RemoveVideo($videoID, $userID);
			$confirmnl = "Video verwijdert";
			$confirmen = "Video deleted";
		} 
		elseif(isset($_POST["edit"])) {
			if(!empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["tags"])) {
				$title = $_POST["title"];
				$description = $_POST["description"];
				if(empty($_FILES["thumbnail"]["name"])) {
					$thumbnail = null;
				} else {
					$thumbnail = $_FILES["thumbnail"];				
				}
				
				$tags = $_POST["tags"];
				$tags = trim($tags, " ");
				$tags = trim($tags, ",");
				
				while (strpos($tags, ",,")) {
					$tags = str_replace(",,", ",", $tags);
				}	
				$tagarray = explode(",", $tags);
				
				foreach($tagarray as $index => $tag) {
					$tag = trim($tag, " ");
					$tagarray[$index] = $tag;
				}
				
				UpdateVideo($videoID, $userID, $title, $description, $thumbnail);
				UpdateTagsFromVideo($userID, $videoID, $tagarray);
				$confirmnl = "Video bijgewerkt";
				$confirmen = "Video updated";
			} else {
				header("location: edit-video.php?id=$videoID");
			}
		}
	}
?>

	<div class="content">
		<div class="content-block">
			<?php if ($_SESSION['language'] == "en") {?>
			<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirmen . '</div>'; } ?>
				<h2>Manage videos</h2>
				<p><a href="account.php">&lt;&lt; Back to account</a></p>
				<div class="block-manage-container">
					<div class="block-add"><a href="add-video.php">&#10010; Add Video</a></div>
			<?php } else { ?>
			<?php if(isset($confirm)) { echo '<div class="form-confirm-block">' . $confirmnl . '</div>'; } ?>
			<h2>Beheer videos</h2>
				<p><a href="account.php">&lt;&lt; Terug naar account</a></p>
				<div class="block-manage-container">
					<div class="block-add"><a href="add-video.php">&#10010; Video toevoegen </a></div>
			<?php } ?>
				<?php
					if($isAdmin) {
						$videos = GetVideos(500);
					} else {
						$videos = GetVideosByUser($userID);
					}
					
					if(!empty($videos)) {
						foreach($videos as $video) {
							echo "<div class='block-title'>
									<a href='delete-video.php?id=" . $video->videoId . "' class='block-title-delete'>&#10006;</a> 
									<a href='edit-video.php?id=" . $video->videoId . "' class='block-title-edit'>&#9998;</a> 
									<a href='video.php?v=" . $video->videoId . "' class='block-title-video'>" . $video->title . "</a>
								</div>";
						}
					} else {
						if ($_SESSION['language'] == "en") {
							echo "<p>There are no videos</p>";
						} else {
							echo "<p>Er zijn geen video's</p>";
						}
					}
				?>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>