function showVideo () {
	//Hide the overlay 
	document.getElementById("video-overlay").style.display = "none";
	document.getElementById("video-placeholder").style.display = "none";
	
	//Show the video
	document.getElementById("video-player").style.display = "block";
}

function uploadRating (rating, videoID, userID) {
	$.ajax({
		url: './rating-execute.php',
		data: {action: rating, action1: videoID, action2: userID},
		type: 'post',
		success: function(output) {
			//alert(output);
		}
	})
}