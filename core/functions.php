<?php
public class DBConnection
{
	private $mysqli;
	
	public __construct()
	{
		$mysqli = new mysqli('localhost', 'root', 'understendingdb');
		
		if ($mysqli->connect_error)
		{
			die("Connect Error ({$mysqli->connect_errno}) {$mysqli->connect_error}");
		}
	}
	
	public 
}



public class CreateVideo
{
	public function Create($userId, $post)
	{
		$title = $post['title'];
		$
		
		return true;
	}
}



public class VideoGateway
{
	
}



public class Video
{
	public $title;
	public $
}

?>