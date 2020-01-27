			<div class="footer">
				<div class="footer-block">
					<img src="imgs/nhl-made-by-students.png" class="nhl-made-by-students">
				</div>
				<div class="footer-block">
				
				</div>
				<div class="footer-block">
				<?php
					if(isset($_GET["id"])) {
						$id = $_GET["id"];
					}
					elseif(isset($_GET["v"])) {
						$id = $_GET["v"];
					}
					echo "<p>";
					if ($_SESSION['language'] == 'en') {
						if(isset($id)) {
							echo "<a href='?language=nl&id=" . $id . "' style='color:white;'>Zet taal naar Nederlands</a>";
						} else {
							echo "<a href='?language=nl' style='color:white;'>Zet taal naar Nederlands</a>";
						}
					} else {
						if(isset($id)) {
							echo "<a href='?language=en&id=" . $id . "' style='color:white;'>Set language to English</a>";
						} else {
							echo "<a href='?language=en' style='color:white;'>Set language to English</a>";
						}
					}
					
					echo "</p>";
					echo "<p>";
					
					if ($_SESSION['style'] == 'dark') {
						echo "<a href='?style=light' style='color:white;'>Light mode</a>";
					} else {
						echo "<a href='?style=dark' style='color:white;'>Dark mode</a>";
					}
					
					echo "</p>";
					
				?>
				</div>
			</div>
		</div>
	</body>
</html>