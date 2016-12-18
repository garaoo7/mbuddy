$(document).ready(function(){
//add
	var regxEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var regxUsername = /^[A-Za-z0-9\-\_]+$/;
  // var temp;

  // $.get("https://www.googleapis.com/youtube/v3/videos",{
  //         part: 'snippet',
  //         id: 'n1a7o44WxNo',
  //         key: 'AIzaSyD6bgYF7YzDhtWX4x1zmsKUz9dRcZDwjKk'
  //         },
  //         function(data){
  //           if(data.pageInfo.totalResults>0){
  //              alert("success");
  //           }
  //           else{
  //             alert("failure");
  //           }
           
  //         }
  // );

	$('#login').click(function(){
//for login button at the the home page    
		$('#errorHomepage').hide();
		$('#homePageHome').hide();
		$('#signupFormHome').hide();
		$('#loginFormHome').show();
	});

	$('#signup').click(function(){
//for signup button at the the home page 
		$('#errorHomepage').hide();
		$('#homePageHome').hide();
		$('#loginFormHome').hide();
		$('#signupFormHome').show();
	});

  function validateSourceUrl(url){
    var result;
    $.ajax({
        url: url,
        dataType: "json",
        async: false,
        success: function(data){
          result = data.pageInfo.totalResults;
          document.getElementById("sourceThumbnail").src=data.items[0].snippet.thumbnails.default.url;
        }
      });

    if(result>0){
      return true;
    }
    else{
      return false;
    }
  }

  // function ajaxCall(aurl, adata, adataType, atype){
  //   $.ajax({
  //       url: aurl,
  //       data: adata,
  //       dataType: adataType,
  //       success: function(result){
  //         temp = result;
  //       },
  //       type: atype
  //     });
  // }


	$('#signupFormSubmit').unbind('click').click(function(){
//xss clean
		
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

      // var url = "http://localhost/mbuddy/index.php/userModule/login/login/";
      // var data = {
      //       'username' : username,
      //       'password' : password,
      //     };
      // var dataType = "json";
      // var type = "POST";
      // var result = ajaxCall(url, data, dataType, type);

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
	});

	$("#logoutButton").unbind('click').click(function(){
//xss clean
  		$.ajax({
    		url: "http://localhost/mbuddy/index.php/userModule/login/logout/",
    		dataType: "json",
    		success: function(result){
	    		if(result == "true"){
	    			window.location.reload();
		    	}
	   		}
    	});
 
	});
//AutoComplete

  // $("#language").autocomplete({
  //   source: "autoCompleteLanguage" // path to the autoComplete method
  //       });
  $("#section").autocomplete({
    source: "autoCompleteSection" // path to the autoComplete method
        });
  $("#artist").autocomplete({
    source: "autoCompleteArtist" // path to the autoComplete method
        });
  $("#singer").autocomplete({
    source: "autoCompleteSinger" // path to the autoComplete method
        });
  $("#composer").autocomplete({
    source: "autoCompleteComposer" // path to the autoComplete method
        });
  $("#writer").autocomplete({
    source: "autoCompleteWriter" // path to the autoComplete method
        });
  $("#producer").autocomplete({
    source: "autoCompleteProducer" // path to the autoComplete method
        });
 

	$('#listingFormSubmit').unbind('click').click(function(){
  //xss clean
    var title       = document.listingForm.title.value.trim();
    var description = document.listingForm.description.value.trim();
    var sourceLink  = document.listingForm.sourceLink.value.trim();
    var lyrics      = document.listingForm.lyrics.value.trim();
    var language    = document.listingForm.language.value.trim();
    var section     = document.listingForm.section.value.trim();
    var artist      = document.listingForm.artist.value.trim();
    var singer      = document.listingForm.singer.value.trim();
    var composer    = document.listingForm.composer.value.trim();
    var writer      = document.listingForm.writer.value.trim();
    var producer    = document.listingForm.producer.value.trim();

    if(title == null || title == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#titleError').html('Title field can not be empty');
      $('#titleError').show(500);
      return false;
    }

    if(description == null || description == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#descriptionError').html('Description field can not be empty');
      $('#descriptionError').show(500);
     return false;
    }
   
    if(sourceLink == null || sourceLink == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#sourceLinkError').html('SourceLink field can not be empty');
      $('#sourceLinkError').show(500);
      return false;
    }

    if(lyrics == null || lyrics == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#lyricsError').html('Lyrics field can not be empty');
      $('#lyricsError').show(500);
      return false;
    }
   if(language == null || language == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#languageError').html('Language field can not be empty');
      $('#languageError').show(500);
      return false;
    }
    if(section == null || section == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#sectionError').html('Category/Section field can not be empty');
      $('#sectionError').show(500);
      return false;
    }
   if(artist == null || artist == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#artistError').html('Artist field can not be empty');
      $('#artistError').show(500);
      return false;
    }
    if(singer == null || singer == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#singerError').html('Singer field can not be empty');
      $('#singerError').show(500);
      return false;
    }
   if(composer == null || composer == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#composerError').html('Composer field can not be empty');
      $('#composerError').show(500);
      return false;
   }
   if(writer == null || writer == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#writerError').html('Writer field can not be empty');
      $('#writerError').show(500);
      return false;
    }
   
   if(producer == null || producer == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#producerError').html('Producer field can not be empty');
      $('#producerError').show(500);
      return false;
    }
    var id;
    $.ajax({
      url: "http://localhost/mbuddy/index.php/postModule/posting/getYoutubeVideoId/",
      data: {
        'sourceLink'    :   sourceLink
      },
      dataType: "json",
      async: false,
      success: function(result){
        id = result;
      },
      type: "POST"
    });
    var url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" + id + "&key=AIzaSyD6bgYF7YzDhtWX4x1zmsKUz9dRcZDwjKk";
    var sourceUrl = validateSourceUrl(url);
    if(!sourceUrl){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#sourceLinkError').html('Please provide a valid link');
      $('#sourceLinkError').show(500);
      return false;
    }

    $.ajax({
      url: "http://localhost/mbuddy/index.php/postModule/posting/postListing/",
      data: {
        'title'       :   title,
        'description' :   description,
        'sourceLink'  :   sourceLink,
        'lyrics'      :   lyrics,
        'language'    :   language,
        'section'     :   section,
        'artist'      :   artist,
        'singer'      :   singer,
        'composer'    :   composer,
        'writer'      :   writer,
        'producer'    :   producer
      },
      dataType: "json",
      success: function(result){

       if(result == "true"){
          $('#producerError').hide(100);
          $('#producerError').html('POST SUCCESSFULL, WILL BE UPLOADED AFTER VERIFICATION');
          $('#producerError').show(500);
        }

        else if(result == "false"){
          $('#producerError').hide(100);
          $('#producerError').html('SOME ERROR OCCURED, PLEASE TRY AGAIN');
          $('#producerError').show(500);
        }
        else{
          $('#producerError').hide(100);
          $('#producerError').html(result);
          $('#producerError').show(500);
        }
      },
      type: "POST"
    });
    
  });
	
	$("#post").unbind('click').click(function(){
//xss clean
  		$.ajax({
    		url: "http://localhost/mbuddy/index.php/postModule/posting/checkUserLogin/",
    		dataType: "json",
    		success: function(result){
    			
	    			if(result == "true"){
						  window.location = "http://localhost/mbuddy/index.php/postModule/posting/index";
		    		}
		    		else if(result =='false'){
		    			$('#homePageHome').hide();
		    			$('#signupFormHome').hide();
		    			$('#errorHomepage').html("YOU NEED TO LOGGGED IN TO POST");
		    			$('#errorHomepage').show();
						  $('#loginFormHome').show();
		    		}
	   			},
	   		type: "POST"

    	});
 
	});

});
