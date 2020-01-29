<?php include "includes/topinclude.php" ?>

	<?php
		if(isset($_POST["submit"])) {
			$email = $_POST["email"];
			$name = $_POST["name"];
			$pass = $_POST["pass"];
			$admin = $_POST["admin"];
			
			$hash = password_hash($pass, PASSWORD_BCRYPT);
			
			$query = "	INSERT INTO user (userTypeID, name, email, password, admin)
						VALUES (1, ?, ?, ?, ?);";
			
			$stmt = mysqli_prepare($conn, $query);
			mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $hash, $admin);
			mysqli_stmt_execute($stmt);
		}
		
	?>
	
	<form action="register.php" method="post">
		<input type="text" name="name" placeholder="Name"><br>
		<input type="text" name="email" placeholder="Email"><br>
		<input type="password" name="pass" placeholder="Password"><br>
		<input type="number" name="admin" placeholder="Admin"><br>
		<input type="submit" value="Register" name="submit">		
	</form>

<?php include "includes/bottominclude.php" ?>