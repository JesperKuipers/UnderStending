<?php
	echo "<h2>Functions</h2>";
	function dirToArray($dir) {
		//$result = array();
		$total = "";

		$cdir = scandir($dir);
		foreach ($cdir as $key => $value) {
			if (!in_array($value,array(".",".."))) {
				if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
					//$result[$value] =
					dirToArray($dir . DIRECTORY_SEPARATOR . $value);
				} else {
					//$result[] = $value;
					if($value !== "functions.php") {
						$path = $dir . DIRECTORY_SEPARATOR . $value;
						$content = file_get_contents($path, FALSE, NULL, 5);
						$content = str_replace("?>", "", $content);
						echo "file content ($value): <br>";
						$total = $total . $content;
					}
					//var_dump($content);
					//echo "<br>";
				}
			}
		}
		file_put_contents("core/functions.php", $total);
		//return $result;
	}
	echo '<pre>' . print_r(dirToArray("core"), TRUE) . '</pre>';
?>