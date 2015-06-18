<!DOCTYPE html>
<html>
<head>
<title>The Orphanage</title>
<link rel="stylesheet" type="text/css" href="swtor.css">
</head>
<body>
<?php
	session_start();
	$_SESSION['message'] = "";
?>
<?php include 'navigation.php';?>

<div id="content">
<?php
echo $_SESSION['message'];

switch (key($_GET)){
	case 'calendar':
		include 'calendar.php';
		break;
	case 'signin':
		include 'signin.php';
		break;
	case 'signup':
		include 'signup.php';
		break;
		
}
/*if(isset($_POST["calendar"])){
	include 'calendar.php';
}
if(isset($_POST["signin"])){
	include 'signin.php';
}
if(isset($_POST["signup"])){
	include 'signup.php';
}*/
?>

</div>
</body>
</html>