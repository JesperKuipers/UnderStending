<?php
$conn = mysqli_connect("localhost", "root", "", "understendingdb");
    // And test the connection
    if(!$conn) {
        DIE("Could not connect: " . mysqli_error($conn));
    }
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT password FROM users WHERE email = ?";
    if($statement = mysqli_prepare($conn, $query)) {
        if (mysqli_stmt_execute($statement)) {
            echo "done";
        } else {
            echo "godsamme";
        }
        echo $yeet;
    }
?>