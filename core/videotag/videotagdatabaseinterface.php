<?php

function AddVideoTagToDatabase($videoId, $tagId)
{
	Insert("insert into videotag values (?, ?)", array($videoId, $tagId), "ii");
}

function RemoveVideoTags($videoId)
{
	Execute("delete from videotag where videoid=?", array($videoId), "i");
}

?>