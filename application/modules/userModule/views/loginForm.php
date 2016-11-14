
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



<a href="<?php echo base_url("index.php/Common/home/index") ?>"><button type="button">Home</button></a>
