<?php
	echo "<h2>Functions</h2>";
	function dirToArray($dir) {
		$result = array();

		$cdir = scandir($dir);
		foreach ($cdir as $key => $value) {
			if (!in_array($value,array(".",".."))) {
				if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
					$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
				} else {
					$result[] = $value;
				}
			}
		}
		return $result;
	}
	echo '<pre>' . print_r(dirToArray("functions"), TRUE) . '</pre>';
?>