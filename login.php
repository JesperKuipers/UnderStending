<?php include "includes/topinclude.php"; ?>

<?php
    include("loginBackend.php");
?>
	<div class="content">
		<div class="content-block">
			<h1>Login</h1>
		</div>
		<div class="formcontainer">
			<form action="login.php" method="post">
					<div class="form-block">
						<div class="form-block-label">email:</div>
						<div class="form-block-field"><input type="text" name="email" /></div>
					<div>
					<div class="form-field">
						<div class="form-block-label">password:</div>
						<div class="form-block-field"><input type="password" name="password" /></div>
					</div>
				</table>
				<input type="submit" name="submit" />
			</form>
		</div>
	</div>

<?php include "includes/bottominclude.php" ?>