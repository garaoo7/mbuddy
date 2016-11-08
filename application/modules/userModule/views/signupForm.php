<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
</head>
<body style="background-color: white">

<form name=signupForm id=signupForm>	

  		<label>Email Address:</label>
  		<input type="text" name="emailAddress" placeholder="email@example.com" value="asd@asd.com">
      <div id="emailError" hidden="true"></div>

		  <label>Username:</label>
  		<input type="text" name="username" placeholder="Username" value="sss">
      <div id="userError">asdasd</div>
  		
  		<label>Password:</label>
  		<input type="password" name="password" placeholder="Password" value="sss">
      <div id="passError" hidden="true"></div>

  		<label>Retype Password:</label>
  		<input type="password" name="repassword" placeholder="Re-password" value="sss">
      <div id="repassError" hidden="true"></div>

      <button id=signupFormSubmit name="submit" type="button">Signup</button>


</form>
<a href="<?php echo base_url("index.php/userModule/home/index") ?>"><button type="button">Home</button></a>

</body>
<script src="<?php echo base_url("jquery/jquery-3.1.1.min.js");?>"></script>
<script src="<?php echo base_url("js/javascript.js");?>"></script>
</html>