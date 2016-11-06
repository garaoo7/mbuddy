<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
</head>
<body style="background-color: white">
<form action="<?php echo base_url("index.php/userModule/login/login") ?>" method="post">	
		<label>Username or Email:</label>
  		<input type="text" name="username" value="Username or email">
  		
  		<label>Password:</label>
  		<input type="password" name="password" value="Password">

  		<input type="submit" name="submit" value="login">

</form>


<a href="<?php echo base_url("index.php/userModule/signup/index") ?>"><button id=signup1 type="button">Signup</button></a>
<a href="<?php echo base_url("index.php/userModule/home/index") ?>"><button type="button">Home</button></a>

</body>
</html>