$(document).ready(function(){


  $('#listingFormSubmit').unbind('click').click(function(){
  //xss clea
    var title = document.listingForm.title.value.trim();
    var description = document.listingForm.description.value.trim();
    var sourceLink = document.listingForm.sourceLink.value.trim();
    var lyrics = document.listingForm.lyrics.value.trim();
    var language = document.listingForm.language.value.trim();
    var artist = document.listingForm.artist.value.trim();
    var composer = document.listingForm.composer.value.trim();
    var writer = document.listingForm.writer.value.trim();
    var producer = document.listingForm.producer.value.trim();

    if(title == null || title == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#titleError').html('Title field can not be empty');
      $('#titleError').show(500);
      return false;
    }

    if(description == null || description == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#descriptionError').html('Description field can not be empty');
      $('#descriptionError').show(500);
     return false;
    }
   
    if(sourceLink == null || sourceLink == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#sourceLinkError').html('SourceLink field can not be empty');
      $('#sourceLinkError').show(500);
      return false;
    }

    if(lyrics == null || lyrics == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#lyricsError').html('Lyrics field can not be empty');
      $('#lyricsError').show(500);
      return false;
    }
   if(language == null || language == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#languageError').html('Language field can not be empty');
      $('#languageError').show(500);
      return false;
    }
   if(artist == null || artist == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#artistError').html('Artist field can not be empty');
      $('#artistError').show(500);
      return false;
    }
   if(composer == null || composer == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#composerError').html('Composer field can not be empty');
      $('#composerError').show(500);
      return false;
   }
   if(writer == null || writer == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#writerError').html('Writer field can not be empty');
      $('#writerError').show(500);
      return false;
    }
   
   if(producer == null || producer == ""){
      $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #artistError, #composerError, #writerError, #producerError').hide(100);
      $('#producerError').html('Producer field can not be empty');
      $('#producerError').show(500);
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
        'artist'      :   artist,
        'composer'    :   composer,
        'writer'      :   writer,
        'producer'    :   producer
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
          $('#repasswordError').html('Verification mail sent, please verify your email address and login through login page');
          $('#repasswordError').show(500);
        }
        else if (result == "false"){
          $('#repasswordError').html('Could not register, please try again');
          $('#repasswordError').show(500);
        }
      },
      type: "POST"
    });
    
  });
});