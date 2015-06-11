<h2>Sign In</h2>
<br>
<form action="" method="post">
  <a href="phpDataBase.php">Product Page</a>
  <a href="signup.php">Sign Up</a>
  <br>
  Data can only be 12 characters long:<br>
  Username: <input type="text" name="user" maxlength="12">
  <br>
  Password: <input type="password" name="pass" maxlength="12">
  <br>
  <input type="submit" value="Submit" name="submit">
  <br>
</form>
<?php
    try {
        if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['submit'])){
        
        $link = new PDO($dsn, $username, $password, $options);
        
	$stmt = $link->prepare("SELECT `User_ID`, `User`, `Pass` FROM `Users` WHERE `User` = '".$_POST['user']."';");
	$stmt->execute();
       	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
       	$stmt->closeCursor();
	
	foreach($user as $u){
		require 'password.php';
		if (password_verify($_POST['pass'], $u['Pass'])){
			$_SESSION['user'] = $_POST['user'];
			$_SESSION["userid"] = $u['User_ID'];
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