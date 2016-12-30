$(document).ready(function(){

	var regxEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var regxUsername = /^[A-Za-z0-9\-\_]+$/;


//Tag it and Auto Suggestor
  $.ajax({
    url: "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_language/",
    dataType: "json",
    success: function(data){
      $('#language').simplyTag({  
        forMultiple: true,               
        dataSource: data,
        isLocal: true,
        key: 'key',
        value: 'value'
      });
    }
  });

  $.ajax({
    url: "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_section/",
    dataType: "json",
    success: function(data){
      $('#section').simplyTag({     
        forMultiple: true,               
        dataSource: data
      });
    }
  });

  $.ajax({
    url: "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_artist/",
    dataType: "json",
    success: function(data){
      $('#artist').simplyTag({     
        forMultiple: true,               
        dataSource: data
      });
    }
  });

  $.ajax({
    url: "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_singer/",
    dataType: "json",
    success: function(data){
      $('#singer').simplyTag({     
        forMultiple: true,               
        dataSource: data
      });
    }
  });

  $.ajax({
    url: "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_composer/",
    dataType: "json",
    success: function(data){
      $('#composer').simplyTag({     
        forMultiple: true,               
        dataSource: data
      });
    }
  });

  $.ajax({
    url: "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_writer/",
    dataType: "json",
    success: function(data){
      $('#writer').simplyTag({     
        forMultiple: true,               
        dataSource: data
      });
    }
  });

  $.ajax({
    url: "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_producer/",
    dataType: "json",
    success: function(data){
      $('#producer').simplyTag({     
        forMultiple: true,               
        dataSource: data
      });
    }
  });

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
	});

	$("#loginFormSubmit").unbind('click').click(function(){
//xss clean
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

      // var url = "http://localhost/mbuddy/index.php/user_module/login/login/";
      // var data = {
      //       'username' : username,
      //       'password' : password,
      //     };
      // var dataType = "json";
      // var type = "POST";
      // var result = ajaxCall(url, data, dataType, type);

      $.ajax({
        url: "http://localhost/mbuddy/index.php/user_module/login/login/",
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
    		url: "http://localhost/mbuddy/index.php/user_module/login/logout/",
    		dataType: "json",
    		success: function(result){
	    		if(result == "true"){
	    			window.location.reload();
		    	}
	   		}
    	});
 
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

 $("#verifySourceUrl").unbind('click').click(function(){
    var id;
    var sourceLink  = document.listingForm.sourceLink.value.trim();
    //**shows snippet error if no valid link is given
    $.ajax({
      url: "http://localhost/mbuddy/index.php/post_module/posting/get_youtube_video_id/",
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
 //console.log("clicked");
  });
  
	$('#listingFormSubmit').unbind('click').click(function(){
  //xss clean

  
    var title           = document.listingForm.title.value.trim();
    var description     = document.listingForm.description.value.trim();
    var sourceLink      = document.listingForm.sourceLink.value.trim();
    var lyrics          = document.listingForm.lyrics.value.trim();
    var language        = [];
    var languageInvalid = [];
    $('#language').siblings('.simply-tags').children('.valid').each(function(){
      language.push($(this).attr('data-key'));
    });
    $('#language').siblings('.simply-tags').children('.invalid').each(function(){
      languageInvalid.push($(this).attr('data-key'));
    });

    var section         = [];
    var sectionInvalid  = [];
    $('#section').siblings('.simply-tags').children('.valid').each(function(){
      section.push($(this).attr('data-key'));
    });
    $('#section').siblings('.simply-tags').children('.invalid').each(function(){
      sectionInvalid.push($(this).attr('data-key'));
    });

    var artist          = [];
    var artistInvalid   = [];
    $('#artist').siblings('.simply-tags').children('.valid').each(function(){
      artist.push($(this).attr('data-key'));
    });
    $('#artist').siblings('.simply-tags').children('.invalid').each(function(){
      artistInvalid.push($(this).attr('data-key'));
    });

    var singer          = [];
    var singerInvalid   = [];
    $('#singer').siblings('.simply-tags').children('.valid').each(function(){
      singer.push($(this).attr('data-key'));
    });
    $('#singer').siblings('.simply-tags').children('.invalid').each(function(){
      singerInvalid.push($(this).attr('data-key'));
    });

    var composer        = [];
    var composerInvalid = [];
    $('#composer').siblings('.simply-tags').children('.valid').each(function(){
      composer.push($(this).attr('data-key'));
    });
    $('#composer').siblings('.simply-tags').children('.invalid').each(function(){
      composerInvalid.push($(this).attr('data-key'));
    });

    var writer          = [];
    var writerInvalid   = [];    
    $('#writer').siblings('.simply-tags').children('.valid').each(function(){
      writer.push($(this).attr('data-key'));
    });
    $('#writer').siblings('.simply-tags').children('.invalid').each(function(){
      writerInvalid.push($(this).attr('data-key'));
    });

    var producer        = [];
    var producerInvalid = [];
    $('#producer').siblings('.simply-tags').children('.valid').each(function(){
      producer.push($(this).attr('data-key'));
    });
    $('#producer').siblings('.simply-tags').children('.invalid').each(function(){
      producerInvalid.push($(this).attr('data-key'));
    });

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
   if((language == null || language == "") && (languageInvalid == null || languageInvalid == "")){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#languageError').html('Language field can not be empty');
      $('#languageError').show(500);
      return false;
    }
    if((section == null || section == "") && (sectionInvalid == null || sectionInvalid == "")){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#sectionError').html('Category/Section field can not be empty');
      $('#sectionError').show(500);
      return false;
    }
   if((artist == null || artist == "") && (artistInvalid == null || artistInvalid == "")){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#artistError').html('Artist field can not be empty');
      $('#artistError').show(500);
      return false;
   }
    if((singer == null || singer == "") && (singerInvalid == null || singerInvalid == "")){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#singerError').html('Singer field can not be empty');
      $('#singerError').show(500);
      return false;
    }
   if((composer == null || composer == "") && (composerInvalid == null || composerInvalid == "")){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#composerError').html('Composer field can not be empty');
      $('#composerError').show(500);
      return false;
   }
   if((writer == null || writer) == "" && (writerInvalid == null || writerInvalid == "")){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#writerError').html('Writer field can not be empty');
      $('#writerError').show(500);
      return false;
    }
   
   if((producer == null || producer == "") && (producerInvalid == null || producerInvalid == "")){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
      $('#producerError').html('Producer field can not be empty');
      $('#producerError').show(500);
      return false;
    }
    var id;
    //**shows snippet error if no valid link is given
    $.ajax({
      url: "http://localhost/mbuddy/index.php/post_module/posting/get_youtube_video_id/",
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
        url: "http://localhost/mbuddy/index.php/post_module/posting/check_user_login/",
        dataType: "json",
        success: function(result){
          
            if(result == "true"){
              $.ajax({
                url: "http://localhost/mbuddy/index.php/post_module/posting/post_listing/",
                data: {
                  'title'           :   title,
                  'description'     :   description,
                  'sourceLink'      :   sourceLink,
                  'lyrics'          :   lyrics,
                  'language'        :   language,
                  'languageInvalid' :   languageInvalid,
                  'section'         :   section,
                  'sectionInvalid'  :   sectionInvalid,
                  'artist'          :   artist,
                  'artistInvalid'   :   artistInvalid,
                  'singer'          :   singer,
                  'singerInvalid'   :   singerInvalid,
                  'composer'        :   composer,
                  'composerInvalid' :   composerInvalid,
                  'writer'          :   writer,
                  'writerInvalid'   :   writerInvalid,
                  'producer'        :   producer,
                  'producerInvalid' :   producerInvalid
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
            }
            else if(result =='false'){
              $('#producerError').hide(100);
              $('#producerError').html("YOU NEED TO LOGGGED IN TO POST");
              $('#producerError').show(500);            
            }
          },
        type: "POST"

      });
    
    
  });
	
	$("#post").unbind('click').click(function(){
//xss clean
  		$.ajax({
    		url: "http://localhost/mbuddy/index.php/post_module/posting/check_user_login/",
    		dataType: "json",
    		success: function(result){
    			
	    			if(result == "true"){
						  window.location = "http://localhost/mbuddy/index.php/post_module/posting/index";
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
