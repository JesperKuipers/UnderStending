<?php
    if(isset($_SESSION['userID'])) {
        header ('Location: index.php');
    }
    if (isset($_POST['submit'])){
        $email = filter_input(htmlentities(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
        $password = filter_input(htmlentities(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS));

        $query = "SELECT password, name, userID FROM user WHERE email = ?;";
        if ($statement = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($statement, "s", $email);
            if (mysqli_stmt_execute($statement)) {
                mysqli_stmt_bind_result($statement, $userPassword, $name, $userID);
                mysqli_stmt_fetch($statement);
                if (password_verify($password, $userPassword)) {
                    $_SESSION['name'] = $name;
                    $_SESSION['userID'] = $userID;
                    header('Location: index.php');
                } else {
                    echo "Email and/or password incorrect.";
                }
            } else {
                echo "Error executing statement";
            }
        } else {
            echo "Error preparing statement.";
        }
    }
    
    
?>