<?php 
    // session_destroy();
    session_start();
?>

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
    // If already logged in, redirect to index.php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
        header("Location: index.php");

    // Login Credentials for admindb
    $username = 'bugmeboss';
    $message = '';
    // $host = 'localhost';
    $host = getenv('IP');
    $dbname = 'bugmedb';
    $password = 'tracker';
    if ($_POST) {
        $email = $_POST["email"];
        $pwd = $_POST["password"];
        if (strlen($email) < 50 && strlen($pwd) < 50) {
            $email_san = filter_var($email, FILTER_SANITIZE_EMAIL);
            $pwd_san = filter_var($pwd, FILTER_SANITIZE_STRING);
            $pwd_hashed = md5($pwd_san);
            // var_dump($pwd_hashed);
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $stmt = $conn->query("SELECT password as pwd FROM users WHERE email='$email'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($result);
            if ($result) {
                if ($pwd_hashed === $result[0]['pwd']) {
                    //Login successful - Redirect to index.html
                    $_SESSION['loggedin'] = True;
                    $_SESSION['timeout'] = time();
                    $_SESSION['user'] = $email_san;
                    header("Location: index.php");
                    exit;
                } else {
                    $message = "<h3>Incorrect Email or Password</h3>";
                }
            }
        }

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
    <div id="messages"><?=$message?></div>
    </main>

    
</body>
</html>