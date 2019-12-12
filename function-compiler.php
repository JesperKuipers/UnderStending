<?php
	echo "<h2>Functions</h2>";
	//Function compiler function
	function functionCompiler($dir) {
		//Scan the given directory
		$cdir = scandir($dir);
		//Loop through all files and directories in given directory
		foreach ($cdir as $key => $filename) {
			//Exclude standard empty directories
			if (!in_array($filename,array(".",".."))) {
				//Check if current file is a directory
				if (is_dir($dir . DIRECTORY_SEPARATOR . $filename)) {
					//Call back to function to loop through nested directory
					functionCompiler($dir . DIRECTORY_SEPARATOR . $filename);
				//Check if current file is a file
				} else {
					//Exclude functions.php
					if($filename !== "functions.php") {
						//Get the path to this file
						$path = $dir . DIRECTORY_SEPARATOR . $filename;
						//Get the contents of this file without the php opening tags
						$content = file_get_contents($path, FALSE, NULL, 5);
						//Take the php closing tags out of the files
						$content = str_replace("?>", "", $content);
						//Get the contents of the current functions.php file
						$current = file_get_contents("core/functions.php");
						//Add the contents of the new current file to functions.php
						$current .= $content;
						
						//Put the new content back into functions.php
						file_put_contents("core/functions.php", $current);
						//Show which file was added
						echo "The function file: ($path) has been added<br>";
					}
				}
			}
		}
	}
	//Empty the current functions.php and add opening php tags at the start
	file_put_contents("core/functions.php", "<?php");
	//Call to the Function compiler function
	functionCompiler("core");
	//Get the contents of the current functions.php file
	$tags = file_get_contents("core/functions.php");
	//Add closing tags to the string of the current functions.php
	$tags .= "?>";
	//Put the new content with the php closing tags back into the functions.php
	file_put_contents("core/functions.php", $tags);
?>