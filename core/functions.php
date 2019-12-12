<?php
class DBConnection
{
	private $mysqli;
	
	public function __construct()
	{
		$mysqli = new mysqli('localhost', 'root', 'understendingdb');
		
		if ($mysqli->connect_error)
		{
			die("Connect Error ({$mysqli->connect_errno}) {$mysqli->connect_error}");
		}
	}
	
}



class CreateVideo
{
	public function Create($userId, $post)
	{
		$title = $post['title'];
		
		return true;
	}
}



class VideoGateway
{
	
}



class Video
{
	public $title;
}

?>