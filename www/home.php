<?php

	session_start();
	include('include/db.php');
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Home</title>

<?php

	$admin_id = $_SESSION ['identity'];
	$username = $_SESSION ['name'];
	

	echo "<p> Admin ID: ". $admin_id ." </p>";
	echo "<p> Username: ". $username ." </p>";
	
?>
</head>

<body>
<hr />
<p> <h2> Hello Here </h2> </p>
<p>......Welcome</p>


</body>
</html>