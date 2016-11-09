<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
</head>
<body style="background-color: white">
<form name=loginForm id=loginForm>	
<!-- showing saved root username and password-->
		<label>Username or Email:</label>
  		<input type="text" name="username" placeholder="Username or email">
  		<div id="usernameErrorL" hidden="true"></div>
  		
  		<label>Password:</label>
  		<input type="password" name="password" placeholder="Password">
  		<div id="passwordErrorL" hidden="true"></div>

  		<button id=loginFormSubmit name="submit" type="button">Login</button>

</form>


<a href="<?php echo base_url("index.php/userModule/signup/index") ?>"><button id=signup1 type="button">Signup</button></a>
<a href="<?php echo base_url("index.php/userModule/home/index") ?>"><button type="button">Home</button></a>

</body>
<script src="<?php echo base_url("jquery/jquery-3.1.1.min.js");?>"></script>
<script src="<?php echo base_url("js/javascript.js");?>"></script>
</html>