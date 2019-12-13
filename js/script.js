function showVideo () {
	//Hide the overlay 
	document.getElementById("video-overlay").style.visibility = "hidden";
	document.getElementById("video-placeholder").style.visibility = "hidden";
	
	//Show the video
	document.getElementById("video-player").style.visibility = "visible";
}