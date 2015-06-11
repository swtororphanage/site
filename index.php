<!DOCTYPE html>
<html>
<head>
<title>The Orphanage</title>
<link rel="stylesheet" type="text/css" href="swtor.css">
</head>
<body>
<?php
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
if(isset($_POST["calendar"])){
	include 'calendar.php';
}
if(isset($_POST["signin"])){
	include 'signin.php';
}
if(isset($_POST["signup"])){
	include 'signup.php';
}
?>

</div>
</body>
</html>