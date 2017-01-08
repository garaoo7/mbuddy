<?php

class Posting extends MX_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("post_model");
		$this->load->model("user_module/user_model");
		$this->load->helper('security');
		$this->load->library("post_module/postlib");

	}

	public function index(){
//***user validation before opening the page	
		$temp = $this->user_model->checkLoggedInUser();
		if($temp){
			$this->load->view('postingPage');
		}
		else{
			// header('Location: '."http://localhost/mbuddy/index.php/user_module/login_signup_page");
			header('Location: '."http://localhost/mbuddy/index.php/home_module/home/index");
			// echo '<script type="text/javascript">
   //       window.location = "http://localhost/mbuddy/index.php/user_module/loginSignupPage?redirect=1"
	  //     </script>';
		}
	}

	public function post_listing(){
		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}
		$temp = $this->user_model->checkLoggedInUser();
		if(!$temp){
			echo json_encode("You need to be logged in to post");
			return;
		}
		else{
			// echo json_encode("true");
			// return true;
	//**user_validation

		$title 				= 	$this->input->post('title', TRUE);
	  	$description 		= 	$this->input->post('description', TRUE);
	    $sourceLink 		= 	$this->input->post('sourceLink', TRUE);
		$lyrics 			= 	$this->input->post('lyrics', TRUE);
	    $language 			= 	$this->input->post('language', TRUE);
	    $languageInvalid 	= 	$this->input->post('languageInvalid', TRUE);
	    $section 			= 	$this->input->post('section', TRUE);
	    $sectionInvalid 	= 	$this->input->post('sectionInvalid', TRUE);
		$artist 			= 	$this->input->post('artist', TRUE);
		$artistInvalid 		= 	$this->input->post('artistInvalid', TRUE);
		$singer 			= 	$this->input->post('singer', TRUE);
		$singerInvalid 		= 	$this->input->post('singerInvalid', TRUE);
	    $composer 			= 	$this->input->post('composer', TRUE);
	    $composerInvalid 	= 	$this->input->post('composerInvalid', TRUE);
		$writer 			= 	$this->input->post('writer', TRUE);
		$writerInvalid 		= 	$this->input->post('writerInvalid', TRUE);
	    $producer 			= 	$this->input->post('producer', TRUE);
	    $producerInvalid 	= 	$this->input->post('producerInvalid', TRUE);
	        // echo json_encode(implode( ", ", $producerInvalid));
	       	// 	return true;
	    	if($title == null || $title == ""){
	     		echo json_encode("Title field can not be empty");
	     	 	return false;
	    	}
	    	if($description == null || $description == ""){
				echo json_encode("Description field can not be empty");
	     	 	return false;
	    	}
	      if($sourceLink == null || $sourceLink == ""){
	      		echo json_encode("SourceLink field can not be empty");
	     	 	return false;
	    	}
		   if($lyrics == null || $lyrics == ""){
		     	echo json_encode("Lyrics field can not be empty");
		     	return false;
		    }
		   if(($language == null || $language == "") && ($languageInvalid == null || $languageInvalid == "")){
		   		echo json_encode("Language field can not be empty");
		     	return false;
		    }
		   if(($section == null || $section == "") && ($sectionInvalid == null || $sectionInvalid == "")){
		   		echo json_encode("Category/Section field can not be empty");
		     	return false;
		    }
		   if(($artist == null || $artist == "") && ($artistInvalid == null || $artistInvalid == "")){
		  		echo json_encode("Artist field can not be empty");
		     	return false;
		    }
		   if(($singer == null || $singer == "") && ($singerInvalid == null || $singerInvalid == "")){
		  		echo json_encode("Singer field can not be empty");
		     	return false;
		    }
		   if(($composer == null || $composer == "") && ($composerInvalid == null || $composerInvalid == "")){
		    	echo json_encode("Composer field can not be empty");
		     	return false;
		   	}
		   if(($writer == null || $writer == "") && ($writerInvalid == null || $writerInvalid == "")){
		     	echo json_encode("Writer field can not be empty");
		     	return false;
		    }
		   
		  	if(($producer == null || $producer == "") && ($producerInvalid == null || $producerInvalid == "")){
		  		echo json_encode("Producer field can not be empty");
		     	return false;
		    }
	//**conditions not checked - same source url enchant_dict_check(dict, word)
		   else{
				$this->load->module('common/ticket_generator');
				$listingID  = $this->ticket_generator->generate_ticket_listing();
				$userID 	= $this->session->userdata('userID');
				$data = array();
				$data['listingData'] 		= array(
					'UserID'					=> $userID,
					'ListingID' 			=> $listingID,
					'ListingTitle'			=> $title,
					'ListingDescription' => $description,
					'ListingSourceLink' 	=> $sourceLink,
					);
	//queries should not be in a loop....insert multple entries at once in one query
	//this all should be in model so that transaction can be applied
	//remove index function.............controller will be loaded through routes
	// user validation in controller (any one with the url can open the page for now)

				foreach ((array)$language as $value){
					$data['languageData'][] = array(
						'LanguageIDa'			=> $value,
						'ListingID' 		=> $listingID
						);
				}
			
				foreach ((array)$section as $value){
					$data['sectionData'][] 		= array(
						'SectionID'			=> $value,
						'ListingID' 		=> $listingID
						);
				}
			
				foreach ((array)$artist as $value){
					$data['artistData'][] 		= array(
						'ArtistID'			=> $value,
						'ListingID' 		=> $listingID
						);
				}
			
				foreach ((array)$singer as $value){
					$data['singerData'][] 		= array(
						'SingerID'			=> $value,
						'ListingID' 		=> $listingID
						);
				}

				foreach ((array)$composer as $value){
					$data['composerData'][] 		= array(
						'ComposerID'		=> $value,
						'ListingID' 		=> $listingID
						);
				}		
			
				foreach ((array)$writer as $value){
					$data['writerData'][] 		= array(
						'WriterID'			=> $value,
						'ListingID' 		=> $listingID
						);
				}
			
				foreach ((array)$producer as $value){
					$data['producerData'][] 		= array(
						'ProducerID'		=> $value,
						'ListingID' 		=> $listingID
						);
				}
			
				$data['invalidData']		= array(
					'ListingID' 			=> $listingID,
					'LanguageName' 		=> (implode( ", ", (array)$languageInvalid)),
					'SectionName' 			=> (implode( ", ", (array)$sectionInvalid)),
					'ArtistName'			=> (implode( ", ", (array)$artistInvalid)),
					'SingerName' 			=> (implode( ", ", (array)$singerInvalid)),
					'ComposerName' 		=> (implode( ", ", (array)$composerInvalid)),
					'WriterName' 			=> (implode( ", ", (array)$writerInvalid)),
					'ProducerName' 		=> (implode( ", ", (array)$producerInvalid))
				);		
				if($this->post_model->insertData($data)){
					echo json_encode("true");
					return;
				}
	//**IS this echoing of true correct or do we need a condition if in case something wrong occurred					
				
			}
		}
	}

	public function check_user_login(){
		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}

		$temp = $this->user_model->checkLoggedInUser();
		if($temp){
			echo json_encode("true");
		}
		else{
			echo json_encode("false");
		}
	}

	public function auto_complete(){
		$value = $this->input->post('value');
		echo json_encode($this->postlib->auto_complete($value));
		// $nameColoumn = ucfirst($value)."Name";
		// $idColoumn = ucfirst($value)."ID";
	 //    echo json_encode($this->post_model->autoSuggestion($nameColoumn, $value, $nameColoumn));
  	}


	public function varify_youtube_url(){
//**filw_get_contents showing error, apache srvr can't resolve dns server
		$sourceUrl = $this->input->post('sourceLink', TRUE);
		parse_str( parse_url( $sourceUrl, PHP_URL_QUERY ), $my_array_of_vars );
		$id = $my_array_of_vars['v'];
      $url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$id."&key=".KEY;
      $contents = json_decode(file_get_contents($url));
      if($contents->pageInfo->totalResults > 0){
      	$thumbnail = $contents->items[0]->snippet->thumbnails->default->url;
      	$data = array(
      		'result'  => 'true',
      		'thumbnail' => $thumbnail
      		);
      }
      else{
      	$data = array(
      		'result'  => 'false'
      		);
      }
       echo json_encode($data);
       return;
	}
}
?>