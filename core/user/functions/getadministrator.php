<?php

function GetAdministrator($userId)
{
	$admin = GetAdminFromDatabase($userId);
	if ($admin)
	{
		return $admin;
	}
	else
	{
		return false;
	}
}

?>