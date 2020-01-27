<?php include "includes/topinclude.php"; ?>

<?php
    include("loginBackend.php");
	if(isset($_SESSION["userID"])) {
		header ('Location: account.php');
	}
?>
<?php if ($_SESSION['language'] == "en") {?>
	<div class="content">
		<div class="content-block">
			<h1>Login</h1>
			<?php if(isset($error)) { ?>
			<div class="form-error-block"><?php echo $error; ?></div>
			<?php } ?>
			<div class="formcontainer">
				<form action="login.php" method="post">
					<div class="form-block">
						<div class="form-block-field">
							<input type="text" name="email" placeholder="E-mail"/>
						</div>
					</div>
					<div class="form-block">
						<div class="form-block-field">
							<input type="password" name="password" placeholder="Password"/>
						</div>
					</div>
					<div class="form-block">
						<input type="submit" name="submit" class="button" value="Log in"/>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } else { ?>
        <div class="content">
		<div class="content-block">
			<h1>Login</h1>
			<?php if(isset($error)) { ?>
			<div class="form-error-block"><?php echo $error; ?></div>
			<?php } ?>
			<div class="formcontainer">
				<form action="login.php" method="post">
					<div class="form-block">
						<div class="form-block-field">
							<input type="text" name="email" placeholder="E-mail"/>
						</div>
					</div>
					<div class="form-block">
						<div class="form-block-field">
							<input type="password" name="password" placeholder="Wachtwoord"/>
						</div>
					</div>
					<div class="form-block">
						<input type="submit" name="submit" class="button" value="Inloggen"/>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>



<?php include "includes/bottominclude.php" ?>