<h2>Sign In</h2>
<br>
<form action="" method="post">
<table style="margin: 0px auto;">
	<tr>
		<td align="right">Email:</td>
		<td><input type="text" name="email" maxlength="12"></td>
	</tr>
	<tr>
		<td align="right">Password:</td>
		<td><input type="password" name="pass" maxlength="12"></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Sign In" name="submit"></td>
	</tr>
</table>
</form>
<?php
if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['submit'])){
    try {
			$link = new PDO($dsn, $username, $password, $options);
			
			$stmt = $link->prepare("SELECT * FROM `User` WHERE `email` = '".$_POST['email']."';");
			$stmt->execute();
			$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
	
			foreach($user as $u){
				require 'password.php';
				if (password_verify($_POST['pass'], $u['Pass'])){
					$_SESSION['name'] = $u['name'];
				}
				else {
					$_SESSION['message'] = 'Wrong Username or Password';
				}
			}
    } catch (Exception $ex) {
        $_SESSION['message'] =  '<p style="color:white;">Couldnt connect to Database try again later</p>';
    }
}
else if (isset($_POST['submit'])){
	$_SESSION['message'] =  'Please enter a valid username and password';
}
?>