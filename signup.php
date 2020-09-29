<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Sign In</title>
</head>
<body>
    <h1 class="mb-4"></h1>
    
    <div class="container">
        <h3 class="mb-4">Register</h3>
        <form action="includes/signup.inc.php" method="post">
            <div class="mb-2">
                <input type="text" name="name" id="name" placeholder="Name">
            </div>
            <div class="mb-2">
                <input type="text" name="email" id="email" placeholder="Email">
            </div>
            <div class="mb-4">
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <button class="btn btn-primary" type="submit" name="signup-submit">Submit</button>
            <a href="login.php" class="btn btn-info">Sign In</a>
        </form>
    </div>
</body>
</html>