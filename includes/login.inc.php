<?php
// checking if the user clicked the login button
if (isset($_POST['login-submit'])) {
    require 'dbh.inc.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    // checking if the fields are empty
    if (empty($email) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    } else {
        // check if the email is correct
        $sql = 'SELECT * FROM users WHERE emailUsers=?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                } else if($pwdCheck == true) {
                    // if password matches, we'll start a session
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['uidUsers'];
                    //header('Location: ../login.php?login=success');
                    header("Location: ../home.php");
                    exit();
                } else {
                    // if pwdCheck contains any values that's not a boolean
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
            } else {
                // if there is no data
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }
}
else {
    // if the login button wasn't pushed
    header("Location: ../login.php");
    exit();
}