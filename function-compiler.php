<?php
	echo "<h2>Functions</h2>";
	function dirToArray($dir) {
		//$result = array();

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
						$content = file_get_contents(, FALSE, NULL, 5);
						$content = str_replace("?>", "", $content);
						echo "file content ($value): <br>";
						file_put_contents("core/functions.php", $content);
					}
					var_dump($content);
					echo "<br>";
				}
			}
		}
		//return $result;
	}
	echo '<pre>' . print_r(dirToArray("functions"), TRUE) . '</pre>';
?>