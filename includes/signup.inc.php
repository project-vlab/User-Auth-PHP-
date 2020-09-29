<?php
    // checking if the user actually clicked the submit button
    if (isset($_POST['signup-submit'])) {  
        // isset() checks whether a variable is set
        // which means that it has to be declared and is not Null
        // returns true if the variable exists and is not NULL
        
        require 'dbh.inc.php';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (empty($name) || empty($email) || empty($password)) {
            header("Location: ../signup.php?error=emptyfields&name=".$name."&email=".$email);
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            header("Location: ../signup.php?error=invalidinputs&name".$name."&email".$email);            
            exit();
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidmail&name=".$name);
            exit();
        } else if(!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            header("Location: ../signup.php?error=invalidname&email".$email);
            exit();
        } else {
            // if the above errors are okay
            // we check the database if the email is already under use
            $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    header("Location: ../signup.php?error=usertaken&name".$name);
                    exit();
                } else {
                    $sql = 'INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)';
                    $stmt = mysqli_stmt_init($conn); 
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../signup.php?signup=success");
                        exit();
                    }
                }

            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    
    } else {
        // if the user did not click the submit button
        header("Location: ../signup.php");
        exit();
    } 