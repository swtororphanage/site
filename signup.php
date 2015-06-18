<h2>Sign Up</h2>
<form action="" method="post">
	<table style="margin: 0px auto;">
		<tr>
			<td align="right">Email:</td>
			<td><input type="email" name="email"></td>
		</tr>
		<tr>
			<td align="right">Password:</td>
			<td><input type="password" name="pass"></td>
		</tr>
		<tr>
			<td align="right">Re-enter Password:</td>
			<td><input type="password" name="pass2"></td>
		</tr>
		<tr>
			<td align="right">SWTOR main character name:</td>
			<td><input type="text" name="name"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Create User" name="submit"></td>
		</tr>
	</table>
</form>

<?php
if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['pass'])
	&& isset($_POST['pass2']) && isset($_POST['name'])){
	if ($_POST['pass'] == $_POST['pass2']){
		try {
			$server = getenv('OPENSHIFT_MYSQL_DB_HOST');
			$dbname = 'swtor';
			$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
			$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
			$dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
			
			$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			
			$link = new PDO($dsn, $username, $password, $options);
			$sql = 'SELECT * FROM `User`;';
			$stmt = $link->prepare($sql);
			$stmt->execute();
			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		
			$message = "";
			foreach($users as $u){
				if($u['name'] == $_POST['name'])
				{
					$message += ' Username is taken.';
				}
				if($u['email'] == $_POST['email'])
				{
					$message += ' Email is taken.';
				}
			}
			if($message == ""){
					alert("hi");
					require 'password.php';
					$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
					$sql = "INSERT INTO `User`(`pass`, `email`, `swtor_name`) VALUES (`"
					.$pass."`,`".$_POST['email']."`,`".$_POST['name']."`);";
					$stmt = $link->prepare($sql);
					$stmt->execute();
					$stmt->closeCursor();
			}
			else {
				echo $message;
			}
		}
		catch (PDOException $e){
			echo 'Sorry no connection, try again later';
		}
	}
	else {
		echo "Passwords were not the same, please try again";
	}
}
else {
	echo 'Please fill in all the information';
}
?>