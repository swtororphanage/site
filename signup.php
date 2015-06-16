<h1>Sign Up</h1>
<form action="" method="post">
<a href="phpDataBase.php">Product Page</a>
<a href="signin.php">Sign In</a>
<br>
<table>
	<tr>
		<td>Email:</td>
		<td><input type="email" name="email"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="pass"></td>
	</tr>
	<tr>
		<td>Re-enter Password:</td>
		<td><input type="password" name="pass2"></td>
	</tr>
	<tr>
		<td>SWTOR main character name:</td>
		<td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td><input type="submit" value="Create User" name="submit"></td>
	</tr>
</table>
</form>

<?php
if(isset($_POST['submit']) && isset($_POST['user']) && isset($_POST['pass'])){
	try {	
        $link = new PDO($dsn, $username, $password, $options);
		$sql = 'SELECT User FROM Users';
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
	
		$message = "";
		foreach($users as $u){
			if($u['User'] == $_POST['user'])
			{
				$message = 'Username is taken.';
			}
		}
	
		if($message == ""){
			require 'password.php';
			$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
			$sql = "INSERT INTO `Users`(`User`, `Pass`) VALUES ('" . $_POST['user'] . "','" .$pass. "');";
				$stmt = $link->prepare($sql);
				$stmt->execute();
				$stmt->closeCursor();
			
			$stmt = $link->prepare("SELECT `User_ID`, `User`, `Pass` FROM `Users` WHERE `User` = '".$_POST['user']."';");
			$stmt->execute();
				$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
			$usid = "";	
			foreach($user as $u){
				$usid = $u['User_ID'];
			}
			for($i = 1; $i <= 6; $i++){
				$sql = "INSERT INTO `Bought_items`(`images_id`, `User_ID`, `bought`) VALUES (".$i.",".$usid.",0);";
					$stmt = $link->prepare($sql);
					$stmt->execute();
					$stmt->closeCursor();
			}
			header('Location: signin.php');
		}
		else {
			echo $message;
		}
		
	}
	catch (PDOException $e){
		echo 'Sorry no connection, try again later';
	}
}
?>