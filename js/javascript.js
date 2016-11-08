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
	      	$('#userError').html('Username field can not be empty');
      		$('#userError').show(500);
      		return false;
    	}
    	else if (!regxUsername.test(username)) {
	    	$('#userError').html('Username field can only have aplha-numeric characters');
      		$('#userError').show(500);
        	return false;
    	}
    
    	if (password == null || password == "") {
	      	$('#passError').html('Password field can not be empty');
      		$('#passError').show(500);
      		return false;
    	}
    	if(password!=repassword){
      		$('#repassError').html("Passwords don't match");
      		$('#repassError').show(500);
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
	    				$('#userError').html('Username already exist');
	      				$('#userError').show(500);
		    		}
		    		else if(result == "emailExist"){
		    			$('#emailError').html('Email Address already exist');
		      			$('#emailError').show(500);
		    		}
		    		else if(result== "true"){ 
		    			//window.location.reload();
		    			$('#repassError').html('Verification mail sent, please verify your email address and login through login page');
		      			$('#repassError').show(500);
		    		}
		    		else if (result == "false"){
		    			$('#repassError').html('Could not register, please try again');
		      			$('#repassError').show(500);
		    		}
		    		else {
		    			$('#repassError').html(result);
		    		}
	   			},
	   		type: "GET"

    	});
	});

	// $("#loginSubmit").unbind('click').click(function(){
	//   	var username = document.loginForm.username.value.trim();
	// 	var password = document.loginForm.password.value.trim();
		
	// 	if(username == null || username == ""){
	//       	$('#usernameError').html('Username field can not be empty');
 //      		$('#usernameError').show(500);
 //      		return false;
 //    	}
    	
    
 //    	if (password == null || password == "") {
	//       	$('#passwordError').html('Password field can not be empty');
 //      		$('#passwordError').show(500);
 //      		return false;
 //    	}
 //  		$.ajax({
 //    		url: "http://localhost/mbuddy/index.php/userModule/login/login/",
 //    		data: {
	//   				'username' : username,
 //    				'password' : password,
 //    			},
 //    		dataType: "json",
 //    		success: function(result){
    			
	//     			if(result == "usernameExist"){
	//     				alert(result); 
	//     				$('#usernameError').html('Username already exist');
	//       				$('#usernameError').show(500);
	// 	    		}
	// 	    		else if(result == 'emailExist'){
	// 	    			$('#emailError').html('Email Address already exist');
	// 	      			$('#emailError').show(500);
	// 	    		}
	// 	    		else if(result== "true"){
	// 	    			alert(result); 
	// 	    			//window.location.reload();
	// 	    			$('#repasswordError').html('Verification mail sent, please verify your email address and login through login page');
	// 	      			$('#repasswordError').show(500);
	// 	    		}
	// 	    		else if (result == 'false'){
	// 	    			$('#repasswordError').html('Could not register, please try again');
	// 	      			$('#repasswordError').show(500);
	// 	    		}
	// 	    		else {
	// 	    			$('#repasswordError').html(result);
	// 	    		}
	//    			},
	//    		type: "GET"

 //    	});
 
	// });

});
