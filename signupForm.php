<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
</head>
<body style="background-color: white">

<form action="<?php echo base_url("index.php/userModule/signup/createUser") ?>" method="post">	

		<label>First Name:</label>
  		<input type="text" name="firstname" value="First Name">

  		<label>Last Name:</label>
  		<input type="text" name="lastname" value="Last Name">

  		<label>Email Address:</label>
  		<input type="text" name="emailAddress" value="email@example.com">

		<label>Username:</label>
  		<input type="text" name="username" value="Username">
  		
  		<label>Password:</label>
  		<input type="password" name="password" value="Password">
  		<label>Retype Password:</label>
  		<input type="password" name="repassword" value="Password">

  		<label>Gender:</label>
  		<input type="radio" name="gender" value="Male" checked>
  		<input type="radio" name="gender" value="Female">
  		<input type="radio" name="gender" value="Other">

  		<input type="submit" name="submit" value="signup">

</form>
<a href="<?php echo base_url("index.php/userModule/home/index") ?>"><button type="button">Home</button></a>

<?php echo validation_errors(); ?>

</body>
</html>