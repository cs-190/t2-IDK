<?php
/* Script to login the user worked on by Jerry and Wilson */
session_set_cookie_params(0);
session_start();

require_once('database.php');

function userLogin($emails, $passwords, $dbs) {
	$sthandler = $dbs->prepare("SELECT * FROM Users WHERE email = '$emails' ");
	$sthandler->execute();
	$result = $sthandler->fetch(PDO::FETCH_ASSOC);
	$hash = $result['password'];
	$activation = $result['activation'];

	if (password_verify($passwords, $hash) && is_null($activation)){
		$_SESSION['logged_in'] = true;
		$return = true;
		$_SESSION['name']=$result['firstname'];
		$_SESSION['email']=$result['email'];
		$_SESSION['userid']=$result['userid'];
		header("Location: dashboard.php");
		exit;
	}
	else {
		$_SESSION["Login.Error"] = 'Invalid Login/Password or account is still unactivated';
		header("Location: login.php");
		exit();
	}
	return $return;
}
	

$emailx = $_POST['NetID'];
$emailx = mysql_real_escape_string($emailx);
$passwordx = $_POST['password'];
$passwordx = mysql_real_escape_string($passwordx);
userLogin($emailx, $passwordx, $db);
?>
