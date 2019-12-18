function showVideo () {
	//Hide the overlay 
	document.getElementById("video-overlay").style.display = "none";
	document.getElementById("video-placeholder").style.display = "none";
	
	//Show the video
	document.getElementById("video-player").style.display = "block";
}