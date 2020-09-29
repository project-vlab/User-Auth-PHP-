<?php
    session_start();
    if (isset($_SESSION['userId'])) {
        echo('
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
                <title>Document</title>
            </head>
            <body>
                <h3>You are logged in</h3>
                <form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Log Out</button>
                </form>
            </body>
            </html>
        ');
    } else {
        header("Location: ./login.php");
        exit();
    }

?>