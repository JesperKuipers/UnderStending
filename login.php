<?php include "includes/topinclude.php"; ?>

<?php
    include("loginBackend.php");
?>
	<div class="content">
		<div class="content-block">
			<h1>Login</h1>
			<div class="formcontainer">
				<form action="login.php" method="post">
						<div class="form-block">
							<div class="form-block-field"><input type="text" name="email" placeholder="E-mail"/></div>
						</div>
						<div class="form-block">
							<div class="form-block-field"><input type="password" name="password" placeholder="Wachtwoord"/></div>
						</div>
						<div class="form-block">
							<input type="submit" name="submit" class="button" value="Inloggen"/>
						</div>
				</form>
			</div>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>