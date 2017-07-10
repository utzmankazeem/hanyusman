<?php
	include 'include/db.php';
	include 'include/functions.php';

	$error= [];

	if(array_key_exists('submit', $_POST)) {

		if(empty($_POST['username'])){
			$error['username'] = "Pease Enter Username";
		}

		if(empty($_POST['password'])){
			$error['password'] = "please enter password";
		}

		if($_POST['pword'] !=$_POST['password']) {
			$error['pword'] = "password does not match";
		}

		if(empty($error)){
			
			$clean = array_map('trim', $_POST);

			$hash = password_hash($clean['password'], PASSWORD_BCRYPT);
			
			$stmt = $conn->prepare("INSERT INTO admin(username, hash) VALUES(:us, :pwrd)");
			
			$data = [

			":us" => $clean['username'],
			 ":pwrd" => $hash	

			 ];

			$stmt->execute($data);
		

		}
	}




?>

	<form action="register.php" method="POST">
		<label>Username:</label>
		<input type="text" name="username" placeholder="Username">
		<br>

		<label>Password:</label>
		<input type="password" name="password" placeholder="Password">
		<br>

		<label>Confirm Password</label>
		<input type="password" name="pword" placeholder="Re-enter Password">
<br/>
		<input type="submit" name="submit" value="submit"> <a href="user.php"> user </a>

		</form>