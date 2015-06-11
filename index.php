<!DOCTYPE html>
<html>
<head>
<title>The Orphanage</title>
<link rel="stylesheet" type="text/css" href="swtor.css">
</head>
<body>
<?php include 'navigation.php';?>

<div id="content">
<img src="Pictures\1.jpg">
<br>1
<br>
<img src="Pictures\2.jpg">
<br>2
<br>
<img src="Pictures\3.jpg">
<br>3
<?php
if(isset($_POST["calendar"])){
	include 'calendar.php';
}
?>

</div>
</body>
</html>