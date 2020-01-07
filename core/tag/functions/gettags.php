<?php

function GetTags($index, $limit)
{
	$tags = GetTagsFromDatabase($index, $limit);
	if (!$tags)
	{
		return array();
	}
	else
	{
		return $tags;
	}
}

?>