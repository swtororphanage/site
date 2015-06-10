<div id="header">
	<h1>The Orphanage</h1>
	<form action="" method="post">
	<div id="alignLog">
	<?php
	if (isset($_SESSION["user"])){
		echo 'Welcome back ' . $_SESSION["user"];
	}
	else {
	?>
		<input type="submit" value="Sign In" name="signin">
		<input type="submit" value="Sign Up" name="signup">
	<?php
	}
	?>
	</div>
	<div id="navigation">
		<input type="submit" value="News" name="news">
		<input type="submit" value="Forums" name="forums">
		<input type="submit" value="Calender" name="calendar">
		<input type="submit" value="Guides" name="guides">
		<input type="submit" value="Officers" name="officer">
		<input type="submit" value="Profile" name="profile">
		<input type="submit" value="Contact" name="contact">
	</div>
	</form>
</div>