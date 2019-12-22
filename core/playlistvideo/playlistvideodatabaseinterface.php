<?php

function RemovePlaylistVideos($videoId)
{
	Execute("delete from playlistvideo where videoid=?", array($videoId), "i");
}

?>