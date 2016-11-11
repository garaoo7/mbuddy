
<form name=signupForm id=signupForm>	

  		<label>Email Address:</label>
  		<input type="text" name="emailAddress" placeholder="email@example.com" value="asd@asd.com">
      <div id="emailError" hidden="true"></div>

		  <label>Username:</label>
  		<input type="text" name="username" placeholder="Username" value="sss">
      <div id="usernameError" hidden="true"></div>
  		
  		<label>Password:</label>
  		<input type="password" name="password" placeholder="Password" value="sss">
      <div id="passwordError" hidden="true"></div>

  		<label>Retype Password:</label>
  		<input type="password" name="repassword" placeholder="Re-password" value="sss">
      <div id="repasswordError" hidden="true"></div>

      <button id=signupFormSubmit name="submit" type="button">Signup</button>


</form>
<a href="<?php echo base_url("index.php/userModule/login/index") ?>"><button id=signup1 type="button">Login</button></a>
<a href="<?php echo base_url("index.php/userModule/home/index") ?>"><button type="button">Home</button></a>
