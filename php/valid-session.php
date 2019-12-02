<?php 
	session_start();
	// var_dump($_SESSION);
	if (!isset($_SESSION['loggedin'])) {
		header("Location: login.php");
		exit;
	} elseif ((time() - $_SESSION['timeout']) > 20*60) {
		// Log out after 20 minutes
		session_destroy();
		header("Location: login.php");
		exit;
	}
	$_SESSION['timeout'] = time();

	function storeErrors($errors) {
		$_SESSION["errors"] = $errors;
	}
?>