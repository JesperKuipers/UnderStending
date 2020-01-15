			<div class="footer">
				<div class="footer-block">
					<img src="imgs/nhl-made-by-students.png" class="nhl-made-by-students">
				</div>
				<div class="footer-block">
                                        <?php
                                            if ($_SESSION['language'] == 'en') {
                                                echo "<a href='?language=nl'>Zet taal naar Nederlands</a>";
                                            } else {
                                                echo "<a href='?language=en'>Set language to English</a>";
                                            }
                                            
                                            echo $_SESSION['language'];
                                        ?>
				</div>
				<div class="footer-block">
				
				</div>
			</div>
		</div>
	<body>
</html>