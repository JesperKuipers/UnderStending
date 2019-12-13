<?php
$conn = mysqli_connect("localhost", "root", "", "understendingdb");
    // And test the connection
    if(!$conn) {
        DIE("Could not connect: " . mysqli_error($conn));
    }
    
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $query = "SELECT password FROM user WHERE email = ?;";
    if($statement = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($statement, "s", $email);
        if (mysqli_stmt_execute($statement)) {
            mysqli_stmt_bind_result($statement, $userPassword);
            mysqli_stmt_fetch($statement);
            if(password_verify($password, $userPassword)){
                echo "You have been logged in.";
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