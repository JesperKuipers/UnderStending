<?php

function RemoveRatingsByVideo($videoId)
{
	Execute("delete from rating where videoid=?", array($videoId), "i");
}

?>