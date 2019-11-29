<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BugMe Issue Tracker</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link href="login.css" type="text/css" rel="stylesheet" />
		
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="scripts/validate_password.js" type="text/javascript"></script>
    <script src="scripts/login.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
</head>
<?php
    if ($_POST) {
        $email = $_POST["email"];
        $pwd = $_POST["password"];
    } else {
        $email = "";
    }

?>

<body>
    <header>
        <ul>
            <li id="header">
                <i class="fas fa-bug"></i>
                BugMe Issue Tracker
            </li>
        </ul>
    </header>
    <main>
    <div id="login">
        <form action="login.php" onsubmit="return login_check(this.password)" method="POST">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" placeholder="Email" value="<?= $email?>"required><br>
            <label for="password">Password:</label>
            <input id="password" type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>
    <div id="messages"></div>
    </main>

    
</body>
</html>