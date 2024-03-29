<?php
require("php/valid-session.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>BugMe Issue Tracker</title>

		<link href="style.css" type="text/css" rel="stylesheet" />
		<!-- <link rel="stylesheet" href="styles/nav.css"> -->
		<!-- <link rel="stylesheet" href="styles/style.css"> -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
      crossorigin="anonymous">
      
		<script src="scripts/nav.js" type="text/javascript"></script>
	</head>

	<body>
		<div class="grid-container">
			<header>
				<ul>
					<li id="header">
						<i class="fas fa-bug"></i>
						BugMe Issue Tracker
					</li>
				</ul>
			</header>
			
				<nav>
					<ul>
						<li id="home" class="nav-div">
							<i class="fas fa-home"></i>
							Home
						</li>
						<?php if ($_SESSION['session_type'] == 'admin') : ?>
						<li id="user" class="nav-div">
							<i class="fas fa-user-plus"></i>
							Add User
						</li>
						<?php endif; ?>
						<li id="issue" class="nav-div">
							<i class="fas fa-plus"></i>
							New Issue
						</li>
						<li id="logout" class="nav-div">
							<i class="fas fa-sign-out-alt"></i>
							Logout
						</li>
					</ul>
				</nav>
				<main id="display"></main>
			
		</div>
	</body>
</html>
