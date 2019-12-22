<?php

function RemoveVideoTags($videoId)
{
	Execute("delete from videotag where videoid=?", array($videoId), "i");
}

?>