
// var courseDetailPageClass = function(obj){
//   var self = this, bindElements = {};
//   bindElements['click'] = ['#test3'];
//   // bindElements['change'] = ['#importantDatesSelect'];
//   // this.CoursePageOnloadItems = function(){}
//   this.bindCoursePageElements = function() {
//     for(var eventName in bindElements) {
//           for(var elementSelector in bindElements[eventName]) {
//             self.bindEvents(eventName,bindElements[eventName][elementSelector]);
//           }
//         }
//   }
  
//   this.bindEvents = function(eventName, elementSelector) {
//     $(document).on(eventName, elementSelector,function(event) {
//       switch(elementSelector) {
//         case '#test3':
//           alert("hey");
//         break;
//       }
//     });
//   }
// };

  var regxEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var regxUsername = /^[A-Za-z0-9\-\_]+$/;

function logout(){
  $.ajax({
     url: "http://localhost/mbuddy/index.php/user_module/login/logout/",
    dataType: "json",
    success: function(result){
       if(result == "true"){
       window.location.reload();
       }
    }
 });  
}

function postingPage(){
        $.ajax({
          url: "http://localhost/mbuddy/index.php/post_module/posting/check_user_login/",
          dataType: "json",
          success: function(result){
            
              if(result == "true"){
                window.location = "http://localhost/mbuddy/index.php/post_module/posting/index";
              }
              else if(result =='false'){
                $('#errorHomepage').html("YOU NEED TO LOGGGED IN TO POST");
                $('#errorHomepage').show();
               }
            },
          type: "POST"

        });
}

function signup(){
    $('#emailError').hide(100);
    $('#usernameError').hide(100);
    $('#passwordError').hide(100);
    $('#repasswordError').hide(100);
    var email       = document.signupForm.emailAddress.value.trim();
    var username    = document.signupForm.username.value.trim();
    var password    = document.signupForm.password.value.trim();
    var repassword  = document.signupForm.repassword.value.trim();

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
        url: "http://localhost/mbuddy/index.php/user_module/signup/create_user/",
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
}

function login(){
    var username = document.loginForm.username.value.trim();
    var password = document.loginForm.password.value.trim();
    
    if(username == null || username == ""){
      $('#usernameErrorL').hide(500);
      $('#passwordErrorL').hide(500);
      $('#usernameErrorL').html('Username field can not be empty');
      $('#usernameErrorL').show(500);
      return false;
    }     
    
    if (password == null || password == "") {
      $('#usernameErrorL').hide(500);
      $('#passwordErrorL').hide(500);
      $('#passwordErrorL').html('Password field can not be empty');
      $('#passwordErrorL').show(500);
      return false;
    }

      $.ajax({
        url: "http://localhost/mbuddy/index.php/user_module/login/login/",
        data: {
            'username' : username,
            'password' : password
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
          else if(result == "incorrectCredentials"){
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
}

$(document).ready(function(){


$("#loginButton").click(function(){
     $("#loginModal").modal();
 });

$("#signupButton").click(function(){
     $("#signupModal").modal();
 });

	$('#signupFormSubmit').unbind('click').click(function(){
//xss clean
		signup();
		
	});

  function getParameterByName(name, url) {
    if (!url) {
      url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

	$("#loginFormSubmit").unbind('click').click(function(){
//xss clean
	 login();
	});

	$("#logoutButton").unbind('click').click(function(){
//xss clean
    logout();
	});
	
	$("#post").unbind('click').click(function(){
    postingPage();

  });
});
