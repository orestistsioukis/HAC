<?php

if (isset($_POST['signup-submit'])) {
    // require connection with database
    require 'dbh.inc.php';

    // assign input from the signup form to the variables
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        // check if the user left empty fields and return the filled except from the password
        header("Location: ../index.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();        
    } 
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        // check if the user put an invalid email && an invalid username
        header("Location: ../index.php?error=invalidmailuid");
        exit();  
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // check if the user put an invalid email return username
        header("Location: ../index.php?error=invalidmail&uid=".$username);
        exit();  
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        // check if the user put an invalid username return email
        header("Location: ../index.php?error=invaliduid&mail=".$email);
        exit();  
    }
    else if ($password !== $passwordRepeat) {
        // check if the user put different passwords
        header("Location: ../index.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit();  
    }
    else {
        // check if the username already exists in the database, using prepared statements for SQL security
        /* uidUsers= $username but we dont do that and we use a PLACEHOLDER ? */
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            // check if the prepared statement made a connection with the database
            header("Location: ../index.php?error=sqlerror");
            exit(); 
        }
        else {
            // pass the statement to the database, "s" = String, "i" = Integer, "b" = Blob, "d" = Double
            // for 2 string statements we do "ss"
            mysqli_stmt_bind_param($stmt, "s", $username);
            // run the statement in the database
            mysqli_stmt_execute($stmt);
            // fetch data from the database
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // checks if the username is already used and if it returns 1 the user needs to change the username if 0 OK
            if ($resultCheck > 0) {
                header("Location: ../index.php?error=usertaken&mail=".$email);
                exit();
            }
            else {
                
                $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit(); 
                }
                else {
                    // hashing users password to save it in the database
                    // PASSWORD_DEFAULT is called bcrypt is a password hashing function
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }

        }

    }
    // closing the statement & the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    // if the user doesn't use the submit button send him back to signup page
    header("Location: ../index.php");
    exit();
}