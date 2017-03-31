<?php
  $linkData = array(
            'css' => array("http://localhost/mbuddy/css/bootstrap.min.css", "http://localhost/mbuddy/css/style.css")
            );
  $this->load->view("common/header", $linkData);
 ?>


<h3>Login Form</h3>
<form role="form" id="loginForm" class="form-inline" name="loginForm">	
	<div class="form-group">
		<label>Username or Email:
			<input type="text" class="form-control" id="usernamePage" name="username" placeholder="Username or email">
		</label>
		<div class="row">
	  	<div class="col-md-6">
	  		<div id="usernameErrorL" hidden></div>
	  	</div>
  	</div>
	</div>

  	<div class="form-group">
  		<label>Password:
  			<input type="password" class="form-control" id="passwordPage" name="password" placeholder="Password">
  		</label>
  		<div class="row">
	  	<div class="col-md-6">
	  		<div id="passwordErrorL" hidden></div>
	  	</div>
  	</div>
  	</div>

  	<button id="loginFormSubmit" class="btn btn-default" name="submit" type="button">Login</button>
</form>





<h3>Signup Form</h3>

<form role="form" id="signupForm" name="signupForm">  
               <div class="form-group">
                  <label>Email Address:
                     <input type="text" class="form-control" name="emailAddress" placeholder="email@example.com" value="asd@asd.com">
                  </label>
                  <div class="row">
                     <div class="col-md-6">
                        <div id="emailError" hidden></div>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label>Username:
                     <input type="text" class="form-control" name="username" placeholder="Username" value="sss">
                  </label>
                  <div class="row">
                     <div class="col-md-6">
                        <div id="usernameError" hidden></div>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label>Password:
                     <input type="password" class="form-control" name="password" placeholder="Password" value="sss">
                  </label>
                  <div class="row">
                     <div class="col-md-6">
                        <div id="passwordError" hidden></div>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label>Retype Password:
                     <input type="password" class="form-control" name="repassword" placeholder="Re-password" value="sss">
                  </label>
                  <div class="row">
                     <div class="col-md-6">
                        <div id="repasswordError" hidden></div>
                     </div>
                  </div>
               </div>

               <button id=signupFormSubmit class="btn btn-default" name="submit" type="button">Signup</button>
            </form>


<a href="<?php echo base_url("index.php/common/home/index") ?>"><button type="button" class="btn btn-default">Home</button></a>



<?php
  $scriptData = array(
            'js' => array("http://localhost/mbuddy/jquery/jquery-3.1.1.min.js", "http://localhost/mbuddy/js/javascript.js", "http://localhost/mbuddy/js/bootstrap.min.js")
            );
  $this->load->view("footer", $scriptData);
 ?>