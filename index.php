<?php
require("php/sessionTest.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>BugMe Issue Tracker</title>

		<link href="style.css" type="text/css" rel="stylesheet" />
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
      crossorigin="anonymous">
      
		<script src="scripts/nav.js" type="text/javascript"></script>
	</head>

	<body>
	    <div id="container">
	        
	        <header>
                <ul>
                    <li id="header">
                        <i class="fas fa-bug"></i>
                        BugMe Issue Tracker
                    </li>
                </ul>
		    </header>
		    
		    <aside>
		        <ul>
                    <li id="home">
                        <i class="fas fa-home"></i>
                        <a>Home</a>
                    </li>
                    <li id="user">
                        <i class="fas fa-user-plus"></i>
                        <a href="">Add User</a>
                    </li>
                    <li id="issue">
                        <i class="fas fa-plus-circle"></i>
                        <a href="">New Issue</a>
                    </li>
                    <li id="logout">
                        <i class="fas fa-power-off"></i>
                        <a href="php/logout.php">Logout</a>
                    </li>
                </ul>
		    </aside>
		    
		    <main>
		        <!-- <h1>New User</h1>
		        
		        <form>
		            <label for="fname">Firstname</label>
		            <input type="text" name="fname" value=""/>
		            
		            <label for="lname">Lastname</label>
		            <input type="text" name="lname" value=""/>
		            
		            <label for="password">Password</label>
		            <input type="text" name="password" value=""/>
		            
		            <label for="email">Email</label>
		            <input type="text" name="email" value=""/>
		            
		            <input type="submit" value="Submit"/>
		        </form> -->
		    </main>
		    
	    </div>
	</body>
</html>