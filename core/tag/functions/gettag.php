<?php

function GetTag($tagId)
{
	$tag = GetTagById($tagId);
	if (!$tag)
	{
		return false;
	}
	else
	{
		return $tag;
	}
}

?>