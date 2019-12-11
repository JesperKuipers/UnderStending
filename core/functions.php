
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

