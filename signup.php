<h1>Sign Up</h1>
<form action="" method="post">
<a href="phpDataBase.php">Product Page</a>
<a href="signin.php">Sign In</a>
<br>
Email: <input type="email" name="email">
<br>
Password:<input type="password" name="pass">
<br>
Re-enter Password:<input type="password" name="pass2">
<br>
SWTOR main character name: <input type="text" name="name">
<br>
<input type="submit" value="Create User" name="submit">
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