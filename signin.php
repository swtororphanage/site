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
    try {
        if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['submit'])){
        
			$link = new PDO($dsn, $username, $password, $options);
			
			$stmt = $link->prepare("SELECT * FROM `User` WHERE `email` = '".$_POST['email']."';");
			$stmt->execute();
			$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
	
			foreach($user as $u){
				require 'password.php';
				if (password_verify($_POST['pass'], $u['Pass'])){
					$_SESSION['user'] = $u['name'];
					$_SESSION["userid"] = $u['user_ID'];
					header('Location: phpDataBase.php');
				}
				else {
					echo 'Wrong Username or Password';
				}
			}
        }
        else if (isset($_POST['submit'])){
        	echo 'Please enter a valid username and password';
        }
    } catch (Exception $ex) {
        echo '<p style="color:white;">Couldnt connect to Database try again later</p>';
    }
?>