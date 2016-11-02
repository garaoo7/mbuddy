$(document).ready(function(){
	$('#loginForm').hide();
	$('#signupForm').hide();

	function home(){
		$('#loggedInUser').hide();
		$('#homePage').show();
	}
	
	function loggedIn(){
		$('#homePage').hide();
		$('#loggedInUser').show();
	}

	

	$('#login').click(function(){
		$('#signupForm').hide();
		$('#homePage').hide();
		$('#loginForm').show();
	
	});

	$('#signup, #signup1').click(function(){
		$('#loginForm').hide();
		$('#homePage').hide();
		$('#signupForm').show();
	});

});
