<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login as Admin</title>
    <link rel="stylesheet" href="../css/login-style.css">
</head>

<body>
    <div class="container">
        <h1 class="title">LOGIN AS<br>ADMINISTRATOR<br><br></h1>
        <form method="POST" action="process/login-session.php">
            <label for="username">Username</label><br>
            <input type="text" class="input" required name="username" required /><br>
            <label for="password">Password</label><br>
            <input type="password" class="input" required name="password" required /><br>
            <input type="submit" name="submit" value="Submit" />
        </form>
        <span class="note">Forgot password? Call 0956-1660-155</span>
    </div>
</body>

</html>
