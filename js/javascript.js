$(document).ready(function(){

	var regxEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var regxUsername = /^[A-Za-z0-9]+$/;


	$('#loginFormHome').hide();
	$('#signupFormHome').hide();

	function home(){
		$('#loggedInUser').hide();
		$('#homePage').show();
	}
	
	function loggedIn(){
		$('#homePage').hide();
		$('#loggedInUser').show();
	}

	

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

    	else if(username == null || username == ""){
	      	$('#usernameError').html('Username field can not be empty');
      		$('#usernameError').show(500);
      		return false;
    	}
    	else if (!regxUsername.test(username)) {
	    	$('#usernameError').html('Username field can only have aplha-numeric characters');
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
	    				$('#usernameError').html('Username already exist');
	      				$('#usernameError').show(500);
		    		}
		    		else if(result == "emailExist"){
		    			$('#emailError').html('Email Address already exist');
		      			$('#emailError').show(500);
		    		}
		    		else if(result== "true"){ 
		    			//window.location.reload();
		    			$('#usernameError').hide(500);
		    			$('#emailError').hide(500);
		    			$('#passwordError').hide(500);
		    			$('#repasswordError').html('Verification mail sent, please verify your email address and login through login page');
		      			$('#repasswordError').show(500);
		    		}
		    		else if (result == "false"){
		    			$('#repasswordError').html('Could not register, please try again');
		      			$('#repasswordError').show(500);
		    		}
		    		else {
		    			$('#repasswordError').html(result);
		    		}
	   			},
	   		type: "GET"

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
		    			$('#passwordErrorL').html('Your Email address is not verified, please verify first');
		      			$('#passwordErrorL').show(500);
		    		}
		    		else if(result== "incorrectCredentials"){
						$('#passwordErrorL').html('Incorrect Username or Password');
		      			$('#passwordErrorL').show(500);
		    		}
	   			},
	   		type: "GET"

    	});
 
	});

});
