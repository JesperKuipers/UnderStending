<?php

function Execute($query, $params, $types)
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
			if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
			{
				return false;//mysqli_stmt_error($stmt);
			}
			else
			{
				if (!mysqli_stmt_execute($stmt))
				{
					return false;//mysqli_stmt_error($stmt);
				}
				else
				{
					return true;
				}
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
}

function Fetch($query, $params, $types)
{
	if (!$conn = mysqli_connect('localhost', 'root', '', 'understendingdb'))
	{
		return 1;//mysqli_connect_error($conn);
	}
	else
	{
		if (!$stmt = mysqli_prepare($conn, $query))
		{
			return 2;//mysqli_error($conn);
		}
		else
		{
			if (!mysqli_stmt_bind_param($stmt, $types, ...$params))
			{
				return 3;//mysqli_stmt_error($stmt);
			}
			else
			{
				if (!mysqli_stmt_execute($stmt))
				{
					return 4;//mysqli_stmt_error($stmt);
				}
				else
				{
					$result = mysqli_stmt_get_result($stmt);
					return mysqli_fetch_all($result);
				}
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}
}

?>