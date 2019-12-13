<?php    
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $query = "SELECT password, name FROM user WHERE email = ?;";
    if($statement = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($statement, "s", $email);
        if (mysqli_stmt_execute($statement)) {
            mysqli_stmt_bind_result($statement, $userPassword, $name);
            mysqli_stmt_fetch($statement);
            if(password_verify($password, $userPassword)){
                session_start();
                $_SESSION['name'] = $name;
                echo "You have been logged in as $name";
            } else {
                echo "Email and/or password incorrect.";
            }
        } else {
            echo "error executing statement";
        }
    } else {
        echo "Error preparing statement.";
    }
?>