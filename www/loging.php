<?php
	include 'include/db.php';

	$error = array();

	if(array_key_exists('submit', $_POST))
	{

		if(empty($_POST['fname']))
		{$error['fname'] = "Enter fname";}
		if(empty($_POST['lname']))
		{$error['lname'] = "Enter lname";}
		if(empty($_POST['Email']))
		{$error['Email'] = "Enter Email";} 
		if(empty($_POST['sex']))
		{$error['sex'] = "Select Gender";}
		if(empty($_POST['Password']))
		{$error['Password'] = "Enter Password";}

		if(empty($error))
		{
			//if email already exist

			$clean = array_map('trim', $_POST);

			$Password = Password_hash($clean['Password'], PASSWORD_BCRYPT);
			$log = $conn->prepare("INSERT INTO user(firstname, lastname, email, Password, gender) VALUES(:fn, :ln, :em, :ps, :gn)");

			$ent = [
			":fn" => $clean['fname'], ":ln"=>$clean['lname'], ":em"=>$clean['Email'], ":ps"=>$Password, ":gn"=>$clean['sex']
			];

			$log->execute($ent);
		}
	}			
?>


<head><title>login</title></head>
<body>
	<form action="loging.php" method="post">
<fieldset><legend>Login</legend>

<label>Firstname</label>
<input type="text" name="fname" placeholder="Firstname">
<br>
<label>Lastname</label>
<input type="text" name="lname" placeholder="Lastname">
<br>
<label>Email</label>
<input type="Email" name="Email" placeholder="Email">
<br>
<label>Gender</label>
<input type="radio" name="sex" value="M">
<input type="radio" name="sex" value="F">
<br>
<label>Password</label>
<input type="Password" name="Password" placeholder="Password">
<br>
<input type="submit" name="submit">
</fieldset>
</form>
</body>