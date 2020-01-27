<?php if ($_SESSION['language'] == "en") {?>

                        <div class="footer">
				<div class="footer-block">
					<img src="imgs/nhl-made-by-students.png" class="nhl-made-by-students">
				</div>
				<div class="footer-block">
				
				</div>
				<div class="footer-block">
                                    <p>
                                        <?php
                                                if ($_SESSION['language'] == 'en') {
                                                        echo "<a href='?language=nl' style='color:white;'>Zet taal naar Nederlands</a>";
                                                } else {
                                                        echo "<a href='?language=en' style='color:white;'>Set language to English</a>";
                                                }

                                        ?>
                                    </p>
                                    <p>
                                        <?php
                                                if ($_SESSION['style'] == 'dark') {
                                                        echo "<a href='?style=light' style='color:white;'>Light mode</a>";
                                                } else {
                                                        echo "<a href='?style=dark' style='color:white;'>Dark mode</a>";
                                                }

                                        ?>
                                    </p>
				</div>
			</div>
		</div>
<?php } else { ?>
                        <div class="footer">
				<div class="footer-block">
					<img src="imgs/nhl-made-by-students.png" class="nhl-made-by-students">
				</div>
				<div class="footer-block">
				
				</div>
				<div class="footer-block">
                                    <p>
                                        <?php
                                                if ($_SESSION['language'] == 'en') {
                                                        echo "<a href='?language=nl' style='color:white;'>Zet taal naar Nederlands</a>";
                                                } else {
                                                        echo "<a href='?language=en' style='color:white;'>Set language to English</a>";
                                                }

                                        ?>
                                    </p>
                                    <p>
                                        <?php
                                                if ($_SESSION['style'] == 'dark') {
                                                        echo "<a href='?style=light' style='color:white;'>Light mode</a>";
                                                } else {
                                                        echo "<a href='?style=dark' style='color:white;'>Dark mode</a>";
                                                }

                                        ?>
                                    </p>
				</div>
			</div>
		</div>
<?php } ?>
            </body>
</html>