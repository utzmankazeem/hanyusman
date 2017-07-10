<?php
	include 'include/db.php';
	
?>

<body>
	<h1>Admin Login</h1>
    <h3>Please enter your Username and Password</h3>
    
    <?php
    
		if (array_key_exists('login', $_POST)) {
			
			$error = array();
			
			if(empty($_POST['uname'])) {
				
				$error['uname'] = "You have not entered username";
				} else {
					$username = mysqli_real_escape_string($_POST['uname']);
					}
			
		if (empty($_POST['password'])) {
				$error['password'] = "You have not entered password";
			} else {
				$pword = md5(mysqli_real_escape_string($_POST['password']));
				}
			
			
			if (empty($error)) {

			$clean = array_map('trim', $_POST);

			$hash = password_hash($clean['password'], PASSWORD_BCRYPT);
			
			$stmt = $conn->prepare("SELECT * FROM admin WHERE username = '".$username."' AND hash = '".$pword."'");
			
			$data = [

			"$username" => $clean['username'],
			 "$pword" => $hash	

			 ];

			$stmt->execute($data);
				
				echo mysqli_num_rows($query);
			 if(mysqli_num_rows($query) == 1)  {
				
			$row = mysqli_fetch_array($query);
			
			//ESTABLISHING SESSION FOR THE ADMIN
			$_SESSION['identity'] = $row['admin_id'];
			$_SESSION['name'] = $row ['username'];
			
			header("Location:home.php"); // LOGGING THE ADMIN IN
				} else { // IF NUMBERS OF ROW IS! ONE
					
					$error_message = "Invalid Username and Password";
					header("Location:login.php?err=$error_message");
					} 
				
			} else {//MEANS ERROR ARAY IS NOT EMPTY
				
				foreach ($error as $error) {
					echo "<p>".$error."</p>";
					}// END OF FOREACH LOOP
				
				}//END OF IF ERROR ARRAY IS EMPTY
			
		} //end of main if
    
	
		
		if (isset($_GET['err'])) {
			
			echo "<p><strong>".$_GET['err'].'</strong></p>';
			}
		
    ?>
    

<h3> Admin Login </h3>

<form action="login.php" method="post">
<fieldset><legend> Welcome To Admin Login </legend>

<label> Username: </label>
<input type="text" name="uname" placeholder="username">
<br>
<label> Password: </label> 
<input type="text" name="password" placeholder="password">
<br/>

<input type="submit" name="login" value="Enter" />

</fieldset>
</form>

</body>
</html>

















