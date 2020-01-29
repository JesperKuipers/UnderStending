// Hide the overlay when the start watching button is clicked and show the video after
function showVideo () {
	//Hide the overlay 
	document.getElementById("video-overlay").style.display = "none";
	document.getElementById("video-placeholder").style.display = "none";
	
	//Show the video
	document.getElementById("video-player").style.display = "block";
}

// Save the rating when the stars are clicked
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

// Rounding function
function round_to_precision(x, precision) {
    var y = +x + (precision === undefined ? 0.5 : precision/2);
    return y - (y % (precision === undefined ? 1 : +precision));
}

// Save the timestamp in the database when the video is paused or finished
function saveTimestamp (videoID, userID, finished) {
	var vid = document.getElementById("video");
	var curTime = round_to_precision(vid.currentTime, 0.01);
	$.ajax({
		url: './timestamp-execute.php',
		data: {action: curTime, action1: videoID, action2: userID, action3: finished},
		type: 'post',
		success: function(output) {
			//alert(output);
		}
	})
}

// Load the timestamp into the video element
function setTimestamp(timestamp) { 
	var vid = document.getElementById("video");	
	vid.currentTime = timestamp;
} 

// Form resubmission fix
if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}