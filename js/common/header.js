

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
                $("#loginModal").modal();
               }
            },
          type: "POST"

        });
}

function signup(){
    $('#emailSignupError').hide(100);
    $('#usernameSignupError').hide(100);
    $('#passwordSignupError').hide(100);
    $('#repasswordSignupError').hide(100);
    var email       = $("#emailSignup").val();
    var username    = $("#usernameSignup").val();
    var password    = $("#passwordSignup").val();
    var repassword  = $("#repasswordSignup").val();

    if(email == null || email == ""){
          $('#emailSignupError').html('Email Address field can not be empty');
          $('#emailSignupError').show(500);
        return false;
      }

      else if (!regxEmail.test(email)) {
          $('#emailSignupError').html('Email Address is invalid');
          $('#emailSignupError').show(500);
          return false;
      }

      if(username == null || username == ""){
          $('#usernameSignupError').html('Username field can not be empty');
          $('#usernameSignupError').show(500);
          return false;
      }
      else if (!regxUsername.test(username)) {
        $('#usernameSignupError').html('Username field can only have aplha-numeric characters, hyphens and underscores');
          $('#usernameSignupError').show(500);
          return false;
      }
    
      if (password == null || password == "") {
          $('#passwordSignupError').html('Password field can not be empty');
          $('#passwordSignupError').show(500);
          return false;
      }
      if(password!=repassword){
          $('#repasswordSignupError').html("Passwords don't match");
          $('#repasswordSignupError').show(500);
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
              $('#usernameSignupError, #emailSignupError, #passwordSignupError, #repasswordSignupError').hide(100);
              $('#usernameSignupError').html('Username already exist');
                $('#usernameSignupError').show(500);
            }
            else if(result == "emailExist"){
              $('#usernameSignupError, #emailSignupError, #passwordSignupError, #repasswordSignupError').hide(100);
              $('#emailSignupError').html('Email Address already exist');
                $('#emailSignupError').show(500);
            }
            else if(result== "true"){ 
              $('#usernameSignupError, #emailSignupError, #passwordSignupError, #repasswordSignupError').hide(100);
              $('#repasswordSignupError').html('Verification mail sent, please verify your email address and login through login page');
                $('#repasswordSignupError').show(500);
            }
            else if (result == "false"){
              $('#usernameSignupError, #emailSignupError, #passwordSignupError, #repasswordSignupError').hide(100);
              $('#repasswordSignupError').html('Could not register, please try again');
                $('#repasswordSignupError').show(500);
            }
            else {
              $('#usernameSignupError, #emailSignupError, #passwordSignupError, #repasswordSignupError').hide(100);
              $('#repasswordSignupError').html(result);
              $('#repasswordSignupError').show(500);
            }
          },
        type: "POST"

      });
}

function login(){
//  val() is not xss_clean
    var username = $("#usernameLogin").val();
    var password = $("#passwordLogin").val();
    
    if(username == null || username == ""){
      $('#userNameLoginError').hide(500);
      $('#passwordLoginError').hide(500);
      $('#userNameLoginError').html('Username field can not be empty');
      $('#userNameLoginError').show(500);
      return false;
    }     
    
    if (password == null || password == "") {
      $('#userNameLoginError').hide(500);
      $('#passwordLoginError').hide(500);
      $('#passwordLoginError').html('Password field can not be empty');
      $('#passwordLoginError').show(500);
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
            $('#userNameLoginError, #passwordLoginError').hide(100);
            $('#passwordLoginError').html('Your Email address is not verified, please verify first');
            $('#passwordLoginError').show(500);
          }
          else if(result == "incorrectCredentials"){
            $('#userNameLoginError, #passwordLoginError').hide(100);
            $('#passwordLoginError').html('Incorrect Username or Password');
            $('#passwordLoginError').show(500);
          }
          else {
            $('#userNameLoginError, #passwordLoginError').hide(100);
            $('#passwordLoginError').html(result);
            $('#passwordLoginError').show(500);
          }
        
       },
        type: "POST"

      });
}

$(document).ready(function(){

  // $("#loadMore").click(function(){
  //   offset,limit
  //     $.ajax({
  //         url:"http://localhost/mbuddy/index.php/post_module/posting/loadmore/?",
  //         data:{
  //           offset :$('#offset').val(),
  //           limit :$('#limit').val()
  //         },
  //         dataType: "json", 
  //         success :function(data){
  //           $(id).html();
  //             $('#testT').html(data.view)
  //             $('#offset').val(data.offset)
  //             $('#limit').val(data.limit)
  //         }
  //     })
  // });


$("#loginButton").click(function(){
    console.log('asda');
     $("#loginModal").modal();
 });

$("#signupButton").click(function(){
     $("#signupModal").modal();
 });

	$('#signupFormSubmit').unbind('click').click(function(){
//xss clean
		signup();
		
	});

    $("#loginFormSubmit").unbind('click').click(function(){
  //xss clean
     login();
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



	$("#logoutButton").unbind('click').click(function(){
//xss clean
    logout();
	});
	
	$("#postButton").unbind('click').click(function(){
    postingPage();

  });
});
