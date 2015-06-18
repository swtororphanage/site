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
    $server = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbname = 'swtor';
    $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
	
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
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