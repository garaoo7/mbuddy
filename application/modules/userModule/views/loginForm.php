<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
</head>
<body>
<form action="loginData" method="post">	
		<label>Username:</label>
  		<input type="text" name="username" value="Username">
  		
  		<label>Password:</label>
  		<input type="password" name="password" value="Password">

  		<input type="submit" name="submit" value="login">

</form>


<a href="signup">signup</a>
</body>
</html>