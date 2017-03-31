var courseDetailPageClass = function(obj){
  var self = this, bindElements = {};
  bindElements['click'] = ['#verifySourceUrl'];
  // bindElements['change'] = ['#importantDatesSelect'];
  // this.CoursePageOnloadItems = function(){}
  this.bindCoursePageElements = function() {
    for(var eventName in bindElements) {
          for(var elementSelector in bindElements[eventName]) {
            self.bindEvents(eventName,bindElements[eventName][elementSelector]);
          }
        }
  }
  
  this.bindEvents = function(eventName, elementSelector) {
    $(document).on(eventName, elementSelector,function(event) {
      switch(elementSelector) {
        case '#verifySourceUrl':
          verifySourceLink('#source');
        break;
      }
    });
  }
};

function postSubmit(){
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

		var instrument          = [];
		var instrumentInvalid   = [];
		$('#instrument').siblings('.simply-tags').children('.valid').each(function(){
			instrument.push($(this).attr('data-key'));
		});
		$('#instrument').siblings('.simply-tags').children('.invalid').each(function(){
			instrumentInvalid.push($(this).text().trim());
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

		var tag          = [];
		var tagInvalid   = [];
		$('#tag').siblings('.simply-tags').children('.valid').each(function(){
			tag.push($(this).attr('data-key'));
		});
		$('#tag').siblings('.simply-tags').children('.invalid').each(function(){
			tagInvalid.push($(this).text().trim());
		});

//**make a common function for all these errors
		function fieldErrors(selector, fieldName1, fieldName2 = null){
			if((fieldName1 == null || fieldName1 == "") && (fieldName2 == null || fieldName2 == "")){
				$('#titleError, #descriptionError, #sourceError, #lyricsError, #languageError, #sectionError, #artistError, #instrumentError, #singerError, #composerError, #writerError, #producerError, #tagError').hide(100);
				$(selector).html('This input field can not be empty');
				$(selector).show(500);
				return false;
			}
			return true;
		}
// var formIds = ['#title','#description'];
// 		(i in formids){
// 	var value = $j(formids[i]).value();
// 	validate(value);
// }

		if(!fieldErrors('#titleError', title)){
			return false;
		}
		if(!fieldErrors('#descriptionError', description)){
			return false;
		}
		if(!fieldErrors('#sourceError', sourceLink)){
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
		if(!fieldErrors('#instrumentError', instrument, instrumentInvalid)){
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
		if(!fieldErrors('#tagError', tag, tagInvalid)){
			return false;
		}

		var id;
		var sourceUrl;
		var sourceLink  = document.listingForm.sourceLink.value.trim();

// 		$.ajax({
// 			url: "http://localhost/mbuddy/index.php/post_module/posting/varify_youtube_url/",
// 			data: {
// 				'sourceLink'    :   sourceLink
// 			},
// 			dataType: "json",
// 			async: false,
// 			success: function(data){
// 			if(data.result == "true"){
// 				$('#sourceError').hide(500);
// 				document.getElementById("sourceThumbnail").src=data.thumbnail;
// 				sourceUrl = true;
// 			}
// 			else{
// //give a note to user........to not to use embedded links, and only the one in the site url
// 				document.getElementById("sourceThumbnail").src="";
// 				$('#sourceError').html("Please provide a Valid link");
// 				$('#sourceError').show(500);
// 				sourceUrl = false;
// 			}
// 		},
// 			type: "POST"
// 		});
		if(!verifySourceLink('#source')){
			$('#titleError, #descriptionError, #sourceError, #lyricsError, #languageError, #sectionError, #artistError, #instrumentError, #singerError, #composerError, #writerError, #producerError, #tagError').hide(100);
			return false;
		}
//no ajax call for userLogin.........there will be a userValdation at backend.......if u want it on front end, try cookies or session
			$.ajax({
				url: "http://localhost/mbuddy/index.php/post_module/posting/post_listing/",
				data: {
					'title'           	:   title,
					'description'     	:   description,
					'sourceLink'      	:   sourceLink,
					'lyrics'          	:   lyrics,
					'language'        	:   language,
					'languageInvalid' 	:   languageInvalid,
					'section'         	:   section,
					'sectionInvalid'  	:   sectionInvalid,
					'artist'          	:   artist,
					'artistInvalid'   	:   artistInvalid,
					'instrument'      	:   instrument,
					'instrumentInvalid':   instrumentInvalid,
					'singer'          	:   singer,
					'singerInvalid'   	:   singerInvalid,
					'composer'        	:   composer,
					'composerInvalid' 	:   composerInvalid,
					'writer'          	:   writer,
					'writerInvalid'   	:   writerInvalid,
					'producer'        	:   producer,
					'producerInvalid' 	:   producerInvalid,
					'tag'        		:   tag,
					'tagInvalid' 		:   tagInvalid
				},
				dataType: "json",
				success: function(result){

				 if(result == "true"){
						$('#titleError, #descriptionError, #sourceError, #lyricsError, #languageError, #sectionError, #artistError, #instrumentError, #singerError, #composerError, #writerError, #producerError, #tagError').hide(100);
						$('#tagError').html('POST SUCCESSFULL, WILL BE UPLOADED AFTER VERIFICATION');
						$('#tagError').show(500);
					}

					else if(result == "false"){
						$('#titleError, #descriptionError, #sourceError, #lyricsError, #languageError, #sectionError, #artistError, #instrumentError, #singerError, #composerError, #writerError, #producerError, #tagError').hide(100);
						$('#tagError').html('SOME ERROR OCCURED, PLEASE TRY AGAIN');
						$('#tagError').show(500);
					}
					else{
						$('#titleError, #descriptionError, #sourceError, #lyricsError, #languageError, #sectionError, #artistError, #instrumentError, #singerError, #composerError, #writerError, #producerError, #tagError').hide(100);
						$('#tagError').html(result);
						$('#tagError').show(500);
					}
				},
				type: "POST"
			});
		}
//**if false open login page
		

function ajaxCall(fieldName){
	var selector = '#' + fieldName;
	var aurl = "http://localhost/mbuddy/index.php/post_module/posting/auto_complete/";
	$.ajax({
			url: aurl,
			data: {
				'fieldName': fieldName
			},
			dataType: "json",
			success: function(data){
				$(selector).simplyTag({  
					forMultiple: true,               
					dataSource: data,
				});
			},
			type: "POST"
		});
}

function verifySourceLink(id){
	var sourceVerified = false;
	var sourceLink  = $(id + 'Link').val().trim();
	$.ajax({
		url: "http://localhost/mbuddy/index.php/post_module/posting/varify_youtube_url/",
		data: {
			'sourceLink'    :   sourceLink
		},
		dataType: "json",
		async: false,
		success: function(data){
			if(data.result == "true"){
				$(id+'Error').hide(500);
				$(id + "Thumbnail").attr('src', data.thumbnail);	
				sourceVerified = true;
			}
			else{
//give a note to user........to not to use embedded links, and only the one in the site url
				$(id +"Thumbnail").src="";
				$(id +'Error').html("Please provide a Valid link");
				$(id +'Error').show(500);
				sourceVerified = false;
			}
		},
		type: "POST"
			});
	return sourceVerified;
}

$(document).ready(function(){

	// $('#language').parents('.simply-tag-root').click(function(){
	// 	alert("asd");
	// });



	var abc = new courseDetailPageClass();
	abc.bindCoursePageElements();

//Tag it and Auto Suggestor
	ajaxCall('language');
	ajaxCall('section');
	ajaxCall('artist');
	ajaxCall('instrument');
	ajaxCall('singer');
	ajaxCall('composer');
	ajaxCall('writer');
	ajaxCall('producer');
	ajaxCall('tag');


//**key should be inside inside controller.......single call to the controller and it will return the complete result
	// $("#verifySourceUrl").unbind('click').click(function(){
	// 	verifySourceLink();
 // //console.log("clicked");
	// });
	
	$('#listingFormSubmit').unbind('click').click(function(){
		postSubmit();
	});
	//xss clean;
});
