<?php session_start() ?>
<html>

	<head>
	<link rel="stylesheet" href="stylehomepage.css">
	<link rel="stylesheet" href="stylenav.css">
	</head>

<body>
	<header>
	<!--  -->
	<?php require_once('navcontrol.php'); ?>
	</header>	
<div class="logo">
 Sign In to buy textbooks
</div>

<div class="forms">

<form action="def.php"  method="post">
<img class="loginpic" src="login.png" alt="Login" ></img>

<input type="text" name="NetID" placeholder="Duke E-mail"><br>
<input type="password" name="password" placeholder="Password"><br>


<input type="submit">
</form>
</div>

</body>
</html>