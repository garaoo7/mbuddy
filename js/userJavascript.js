$(document).ready(function(){
//add
	var regxEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var regxUsername = /^[A-Za-z0-9\-\_]+$/;

	

	$('#login').click(function(){
		$('#signupFormHome').hide();
		$('#homePage').hide();
		$('#loginFormHome').show();

	});

	$('#signup, #signup1').click(function(){
		$('#loginFormHome').hide();
		$('#homePage').hide();
		$('#signupFormHome').show();
	});

	$('#signupFormSubmit').unbind('click').click(function(){
//xss clean
		
		$('#emailError').hide(100);
		$('#usernameError').hide(100);
		$('#passwordError').hide(100);
		$('#repasswordError').hide(100);
		var email = document.signupForm.emailAddress.value.trim();
		var username = document.signupForm.username.value.trim();
		var password = document.signupForm.password.value.trim();
		var repassword = document.signupForm.repassword.value.trim();

		if(email == null || email == ""){
      		$('#emailError').html('Email Address field can not be empty');
      		$('#emailError').show(500);
     	 	return false;
    	}

    	else if (!regxEmail.test(email)) {
        	$('#emailError').html('Email Address is invalid');
      		$('#emailError').show(500);
        	return false;
    	}

    	if(username == null || username == ""){
	      	$('#usernameError').html('Username field can not be empty');
      		$('#usernameError').show(500);
      		return false;
    	}
    	else if (!regxUsername.test(username)) {
	    	$('#usernameError').html('Username field can only have aplha-numeric characters, hyphens and underscores');
      		$('#usernameError').show(500);
        	return false;
    	}
    
    	if (password == null || password == "") {
	      	$('#passwordError').html('Password field can not be empty');
      		$('#passwordError').show(500);
      		return false;
    	}
    	if(password!=repassword){
      		$('#repasswordError').html("Passwords don't match");
      		$('#repasswordError').show(500);
      		return false;
    	}


    	$.ajax({
    		url: "http://localhost/mbuddy/index.php/userModule/signup/createUser/",
    		data: {
   					'emailAddress' : email,
	  				'username' : username,
    				'password' : password,
    				'repassword' : repassword
    			},
    		dataType: "json",
    		success: function(result){
    			
	    			if(result == "usernameExist"){
	    				$('#usernameError, #emailError, #passwordError, #repasswordError').hide(100);
	    				$('#usernameError').html('Username already exist');
	      				$('#usernameError').show(500);
		    		}
		    		else if(result == "emailExist"){
		    			$('#usernameError, #emailError, #passwordError, #repasswordError').hide(100);
		    			$('#emailError').html('Email Address already exist');
		      			$('#emailError').show(500);
		    		}
		    		else if(result== "true"){ 
		    			$('#usernameError, #emailError, #passwordError, #repasswordError').hide(100);
		    			$('#repasswordError').html('Verification mail sent, please verify your email address and login through login page');
		      			$('#repasswordError').show(500);
		    		}
		    		else if (result == "false"){
		    			$('#usernameError, #emailError, #passwordError, #repasswordError').hide(100);
		    			$('#repasswordError').html('Could not register, please try again');
		      			$('#repasswordError').show(500);
		    		}
		    		else {
		    			$('#usernameError, #emailError, #passwordError, #repasswordError').hide(100);
		    			$('#repasswordError').html(result);
		    			$('#repasswordError').show(500);
		    		}
	   			},
	   		type: "POST"

    	});
	});

	$("#loginFormSubmit").unbind('click').click(function(){
//xss clean
	  	var username = document.loginForm.username.value.trim();
		var password = document.loginForm.password.value.trim();
		
		if(username == null || username == ""){
			$('#usernameErrorL').html('Username field can not be empty');
	 		$('#usernameErrorL').show(500);
      		return false;
    	}   	
    
    	if (password == null || password == "") {
	      	$('#passwordErrorL').html('Password field can not be empty');
      		$('#passwordErrorL').show(500);
      		return false;
    	}
  		$.ajax({
    		url: "http://localhost/mbuddy/index.php/userModule/login/login/",
    		data: {
	  				'username' : username,
    				'password' : password,
    			},
    		dataType: "json",
    		success: function(result){
    			
	    			if(result == "true"){
	    				window.location.reload();
		    		}
		    		else if(result == "accountNotActivated"){
		    			$('#usernameErrorL, #passwordErrorL').hide(100);
		    			$('#passwordErrorL').html('Your Email address is not verified, please verify first');
		      			$('#passwordErrorL').show(500);
		    		}
		    		else if(result== "incorrectCredentials"){
		    			$('#usernameErrorL, #passwordErrorL').hide(100);
						$('#passwordErrorL').html('Incorrect Username or Password');
		      			$('#passwordErrorL').show(500);
		    		}
		    		else {
		    			$('#usernameErrorL, #passwordErrorL').hide(100);
		    			$('#passwordErrorL').html(result);
		    			$('#passwordErrorL').show(500);
		    		}
	   			},
	   		type: "POST"

    	});
 
	});

	$("#logoutButton").unbind('click').click(function(){
//xss clean
  		$.ajax({
    		url: "http://localhost/mbuddy/index.php/userModule/login/logout/",
    		dataType: "json",
    		success: function(result){
	    		if(result == "true"){
	    			window.location.assign("http://localhost/mbuddy/index.php/userModule/home/index/");
		    	}
	   		}
    	});
 
	});

});
