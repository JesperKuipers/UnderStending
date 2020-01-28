<?php

function ImplodeItemByCount($glue, $item, $count)
{
	//array van items
	$items = [];
	//lus door count
	for ($i = 0; $i < $count; $i++)
	{
		$items[] = $item;
	}
	//maak string van items d.m.v glue
	return implode($glue, $items);
}

?>