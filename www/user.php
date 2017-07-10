//firstname, lastname, email, password, gender.
<?php
	include 'include/db.php';

	$error = [];

	if(array_key_exists('submit', $_POST)) {

		if(empty($_POST['fname'])){
			$error['fname'] = "Enter Firstname";
		}

		if(empty($_POST['lname'])){
			$error['lname'] = "Enter Lastname";
		}

		if(empty($_POST['email'])){
			$error['email'] = 'Enter email';
		}

		if(empty($_POST['password'])){
			$error['password'] = 'Enter Password';
		}

		if(empty($_POST['sex'])){
			$error['sex'] = 'Select Gender';
		}

		if(empty($error)){

			$clean = array_map('trim', $_POST);

			$password = password_hash($clean['password'], PASSWORD_BCRYPT);

			$ins = $conn->prepare("INSERT INTO user(firstname, lastname, email, password, gender) VALUES(:fn, :ln, :em, :pwrd, :gen)");

			$data = [
			":fn" => $clean['fname'],
			":ln" => $clean['lname'],
			":em" => $clean['email'],
			":pwrd" => $password,
			":gen" => $clean['sex'],
			];

			$ins->execute($data);
		}
	}


?>

<head> <title>users</title></head>
<body>
<form action="user.php" method="post">
<fieldset><legend>Register Users</legend>

<label>Firstname:</label>
<input type="text" name="fname" placeholder="firstname"><br/>

<label>Lastname:</label>
<input type="text" name="lname" placeholder="lastname"><br/>

<label>Email:</label>
<input type="email" name="email" placeholder="user@swapspace.com"><br/>

<label>Password:</label>
<input type="password" name="password" placeholder="password"><br/>

<label>Gender:</label>
<input type="radio" name="sex" value="M"> <input type="radio" name="sex" value="F"> <br/>

<input type="submit" name="submit"> <a href="register.php"> admin </a>
</fieldset>
</form>
</body>