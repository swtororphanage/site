<!DOCTYPE html>
<html>
<head>
<title>The Orphanage</title>
<link rel="stylesheet" type="text/css" href="swtor.css">
</head>
<body>
<?php include 'navigation.php';?>

<div id="content">

<?php
if(isset($_POST["calendar"])){
	include 'calendar.php';
}
?>

</div>
</body>
</html>