
$(document).ready(function(){

//Tag it and Auto Suggestor

	function ajaxCall(aurl, afunction){
		$.ajax({
				url: aurl,
				dataType: "json",
				success: function(result){
					afunction(result);
				},
				type: "POST"
			});
	}

	var url = "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_language/";
		function languageFunct(data){
			$('#language').simplyTag({  
				forMultiple: true,               
				dataSource: data,
			});
		}
		ajaxCall(url, languageFunct);

	var url = "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_section/";
	function sectionFunct(data){
			$('#section').simplyTag({  
				forMultiple: true,               
				dataSource: data,
			});
		}
	ajaxCall(url, sectionFunct);


	var url = "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_artist/";
	function artistFunct(data){
		$('#artist').simplyTag({  
			forMultiple: true,               
			dataSource: data,
		});
	}
	ajaxCall(url, artistFunct);

	var url = "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_singer/";
	function singerFunct(data){
		$('#singer').simplyTag({  
			forMultiple: true,               
			dataSource: data,
		});
	}
	ajaxCall(url, singerFunct);

	var url = "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_composer/";
	function composerFunct(data){
		$('#composer').simplyTag({  
			forMultiple: true,               
			dataSource: data,
		});
	}
	ajaxCall(url, composerFunct);

	var url = "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_writer/";
	function writerFunct(data){
		$('#writer').simplyTag({  
	 		forMultiple: true,               
	 		dataSource: data,
	 	});
 	}
	ajaxCall(url, writerFunct);


	var url = "http://localhost/mbuddy/index.php/post_module/posting/auto_complete_producer/";
	function producerFunct(data){
		$('#producer').simplyTag({  
			forMultiple: true,               
			dataSource: data,
		});
	}
	ajaxCall(url, producerFunct);


//**key should be inside inside controller.......single call to the controller and it will return the complete result
	 $("#verifySourceUrl").unbind('click').click(function(){
			var id;
			var sourceLink  = document.listingForm.sourceLink.value.trim();
			$.ajax({
				url: "http://localhost/mbuddy/index.php/post_module/posting/varify_youtube_url/",
				data: {
					'sourceLink'    :   sourceLink
				},
				dataType: "json",
				async: false,
				success: function(result){
					if(result =="true"){
						$('#sourceLinkError').html('valid');
						$('#sourceLinkError').show(500);
//            document.getElementById("sourceThumbnail").src=data.items[0].snippet.thumbnails.default.url;
					}
					else{
						$('#sourceLinkError').html('Please provide a valid link');
						$('#sourceLinkError').show(500);
					}
				},
				type: "POST"
			});
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
		//xss clean in valid elements too......someone can change the javascript in frontend
		$('#language').siblings('.simply-tags').children('.valid').each(function(){
			language.push($(this).attr('data-key'));
		});
		$('#language').siblings('.simply-tags').children('.invalid').each(function(){
			languageInvalid.push($(this).text().trim());
		});
		var section         = [];
		var sectionInvalid  = [];
		$('#section').siblings('.simply-tags').children('.valid').each(function(){
			section.push($(this).attr('data-key'));
		});
		$('#section').siblings('.simply-tags').children('.invalid').each(function(){
			sectionInvalid.push($(this).text().trim());
		});

		var artist          = [];
		var artistInvalid   = [];
		$('#artist').siblings('.simply-tags').children('.valid').each(function(){
			artist.push($(this).attr('data-key'));
		});
		$('#artist').siblings('.simply-tags').children('.invalid').each(function(){
			artistInvalid.push($(this).text().trim());
		});

		var singer          = [];
		var singerInvalid   = [];
		$('#singer').siblings('.simply-tags').children('.valid').each(function(){
			singer.push($(this).attr('data-key'));
		});
		$('#singer').siblings('.simply-tags').children('.invalid').each(function(){
			singerInvalid.push($(this).text().trim());
		});

		var composer        = [];
		var composerInvalid = [];
		$('#composer').siblings('.simply-tags').children('.valid').each(function(){
			composer.push($(this).attr('data-key'));
		});
		$('#composer').siblings('.simply-tags').children('.invalid').each(function(){
			composerInvalid.push($(this).text().trim());
		});

		var writer          = [];
		var writerInvalid   = [];    
		$('#writer').siblings('.simply-tags').children('.valid').each(function(){
			writer.push($(this).attr('data-key'));
		});
		$('#writer').siblings('.simply-tags').children('.invalid').each(function(){
			writerInvalid.push($(this).text().trim());
		});

		var producer        = [];
		var producerInvalid = [];
		$('#producer').siblings('.simply-tags').children('.valid').each(function(){
			producer.push($(this).attr('data-key'));
		});
		$('#producer').siblings('.simply-tags').children('.invalid').each(function(){
			producerInvalid.push($(this).text().trim());
		});
//**make a common function for all these errors
		function fieldErrors(selector, fieldName1, fieldName2 = null){
			if((fieldName1 == null || fieldName1 == "") && (fieldName2 == null || fieldName2 == "")){
				$('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
				$(selector).html('This field can not be empty');
				$(selector).show(500);
				return false;
			}
			return true;
		}

		if(!fieldErrors('#titleError', title)){
			return false;
		}
		if(!fieldErrors('#descriptionError', description)){
			return false;
		}
		if(!fieldErrors('#sourceLinkError', sourceLink)){
			return false;
		}
		if(!fieldErrors('#lyricsError', lyrics)){
			return false;
		}
		if(!fieldErrors('#languageError', language, languageInvalid)){
			return false;
		}
		if(!fieldErrors('#sectionError', section, sectionInvalid)){
			return false;
		}
		if(!fieldErrors('#artistError', artist, artistInvalid)){
			return false;
		}
		if(!fieldErrors('#singerError', singer, singerInvalid)){
			return false;
		}
		if(!fieldErrors('#composerError', composer, composerInvalid)){
			return false;
		}
		if(!fieldErrors('#writerError', writer, writerInvalid)){
			return false;
		}
		if(!fieldErrors('#producerError', producer, producerInvalid)){
			return false;
		}

		var id;
		var sourceUrl;
		var sourceLink  = document.listingForm.sourceLink.value.trim();
		$.ajax({
			url: "http://localhost/mbuddy/index.php/post_module/posting/varify_youtube_url/",
			data: {
				'sourceLink'    :   sourceLink
			},
			dataType: "json",
			async: false,
			success: function(result){
				if(result =="true"){
					sourceUrl = true;
//          document.getElementById("sourceThumbnail").src=data.items[0].snippet.thumbnails.default.url;
				}
			},
			type: "POST"
		});
		if(!sourceUrl){
			$('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
			$('#sourceLinkError').html('Please provide a valid link');
			$('#sourceLinkError').show(500);
			return false;
		}
//no ajax call for userLogin.........there will be a userValdation at backend.......if u want it on front end, try cookies or session
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
										 $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
										 $('#producerError').html('POST SUCCESSFULL, WILL BE UPLOADED AFTER VERIFICATION');
										 $('#producerError').show(500);
									}

									else if(result == "false"){
										 $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
										 $('#producerError').html('SOME ERROR OCCURED, PLEASE TRY AGAIN');
										 $('#producerError').show(500);
									}
									else{
										 $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
										 $('#producerError').html(result);
										 $('#producerError').show(500);
									}
								},
								type: "POST"
							});
						}
//**if false open login page
						else if(result =='false'){
							 $('#titleError, #descriptionError, #sourceLinkError, #lyricsError, #languageError, #sectionError, #artistError, #singerError, #composerError, #writerError, #producerError').hide(100);
							 $('#producerError').html("YOU NEED TO LOGGGED IN TO POST");
							 $('#producerError').show(500);            
						}
					},
				type: "POST"

			});
		
		
	});
	
});
