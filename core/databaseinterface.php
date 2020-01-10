<?php

function Execute($query, $params = array(), $types = "")
{
	if (!$conn = mysqli_connect('localhost', 'root', '', 'understendingdb'))
	{
		return false;//mysqli_connect_error($conn);
	}
	else
	{
		if (!$stmt = mysqli_prepare($conn, $query))
		{
			return false;//mysqli_error($conn);
		}
		else
		{ 
			if (!empty($types))
			{
				if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
				{
					return false;//return mysqli_stmt_error($stmt);
				}
			}
			if (!mysqli_stmt_execute($stmt))
			{
				return false;//mysqli_stmt_error($stmt);
			}
			else
			{
				return true;
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
}

function Fetch($query, $params = array(), $types = "")
{
	if (!$conn = mysqli_connect('localhost', 'root', '', 'understendingdb'))
	{
		return false;//mysqli_connect_error($conn);
	}
	else
	{
		if (!$stmt = mysqli_prepare($conn, $query))
		{
			return false;//mysqli_error($conn);
		}
		else
		{
			if (!empty($types))
			{
				if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
				{
					return false;//mysqli_stmt_error($stmt);
				}
			}
			if (!mysqli_stmt_execute($stmt))
			{
				return false;//mysqli_stmt_error($stmt);
			}
			else
			{
				$result = mysqli_stmt_get_result($stmt);
				return mysqli_fetch_all($result);
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
}

?>