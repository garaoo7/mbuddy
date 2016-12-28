<?php

class Posting extends MX_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("post_model");
		$this->load->helper('security');

	}

	public function index(){
		$this->load->view('postingPage');

	}

	public function post_listing(){
		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}

		$title 			= 	$this->input->post('title', TRUE);
  		$description 	= 	$this->input->post('description', TRUE);
        $sourceLink 	= 	$this->input->post('sourceLink', TRUE);
        $lyrics 		= 	$this->input->post('lyrics', TRUE);
        $language 		= 	$this->input->post('language', TRUE);
        $section 		= 	$this->input->post('section', TRUE);
        $artist 		= 	$this->input->post('artist', TRUE);
        $singer 		= 	$this->input->post('singer', TRUE);
        $composer 		= 	$this->input->post('composer', TRUE);
        $writer 		= 	$this->input->post('writer', TRUE);
        $producer 		= 	$this->input->post('producer', TRUE);
       		
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
	   	if($language == null || $language == ""){
	   		echo json_encode("Language field can not be empty");
	     	return false;
	    }
	    if($section == null || $section == ""){
	   		echo json_encode("Category/Section field can not be empty");
	     	return false;
	    }
	   	if($artist == null || $artist == ""){
	  		echo json_encode("Artist field can not be empty");
	     	return false;
	    }
	    if($singer == null || $singer == ""){
	  		echo json_encode("Singer field can not be empty");
	     	return false;
	    }
	   	if($composer == null || $composer == ""){
	    	echo json_encode("Composer field can not be empty");
	     	return false;
	   	}
	   	if($writer == null || $writer == ""){
	     	echo json_encode("Writer field can not be empty");
	     	return false;
	    }
	   
	  	if($producer == null || $producer == ""){
	  		echo json_encode("Producer field can not be empty");
	     	return false;
	    }
//**conditions not checked - same source url enchant_dict_check(dict, word)
	    else{
			$this->load->module('common/ticket_generator');

			$artistTemp = $this->post_model->entryExist($artist, 'ArtistName', 'artist');
			if($artistTemp){
				$artistID = $artistTemp->ArtistID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$artistID = $this->ticket_generator->generate_ticket_artist();
			// 	$artistData = array(
			// 		'ArtistID' => $artistID,
			// 		'ArtistName' => $artist
			// 		);
			// 	$this->post_model->insertData($artistData, 'artist');
			// }

			$composerTemp = $this->post_model->entryExist($composer, 'ComposerName', 'composer');
			if($composerTemp){
				$composerID = $composerTemp->ComposerID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$composerID = $this->ticket_generator->generate_ticket_composer();
			// 	$composerData = array(
			// 		'ComposerID' => $composerID,
			// 		'ComposerName' => $composer
			// 		);
			// 	$this->post_model->insertData($composerData, 'composer');
			// }

			$producerTemp = $this->post_model->entryExist($producer, 'ProducerName', 'producer');
			if($producerTemp){
				$producerID = $producerTemp->ProducerID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$producerID = $this->ticket_generator->generate_ticket_producer();
			// 	$producerData = array(
			// 		'ProducerID' => $producerID,
			// 		'ProducerName' => $producer
			// 		);
			// 	$this->post_model->insertData($producerData, 'producer');
			// }

			$sectionTemp = $this->post_model->entryExist($section, 'SectionName', 'section');
			if($sectionTemp){
				$sectionID = $sectionTemp->SectionID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$sectionID = $this->ticket_generator->generate_ticket_section();
			// 	$sectionData = array(
			// 		'SectionID' => $sectionID,
			// 		'SectionName' => $section
			// 		);
			// 	$this->post_model->insertData($sectionData, 'section');
			// }

			$writerTemp = $this->post_model->entryExist($writer, 'WriterName', 'writer');
			if($writerTemp){
				$writerID = $writerTemp->WriterID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$writerID = $this->ticket_generator->generate_ticket_writer();
			// 	$writerData = array(
			// 		'WriterID' => $writerID,
			// 		'WriterName' => $writer
			// 		);
			// 	$this->post_model->insertData($writerData, 'writer');
			// }

			$singerTemp = $this->post_model->entryExist($singer, 'SingerName', 'singer');
			if($singerTemp){
				$singerID = $singerTemp->SingerID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$singerID = $this->ticket_generator->generate_ticket_singer();
			// 	$singerData = array(
			// 		'SingerID' => $singerID,
			// 		'SingerName' => $singer
			// 		);
			// 	$this->post_model->insertData($singerData, 'singer');
			// }

			$listingID  = $this->ticket_generator->generate_ticket_listing();
			$userID 	= $this->session->userdata('userID');
			$data 		= array(
				'UserID'				=> $userID,
				'ListingID' 			=> $listingID,
				'ListingTitle'			=> $title,
				'ListingDescription' 	=> $description,
				'ListingSourceLink' 	=> $sourceLink,
				);
			$this->post_model->insertData($data, 'listing');

			$data 		= array(
				'ArtistID'				=> $artistID,
				'ListingID' 			=> $listingID
				);
			$this->post_model->insertData($data, 'listing_artist_relation');

			$data 		= array(
				'ComposerID'				=> $composerID,
				'ListingID' 			=> $listingID
				);
			$this->post_model->insertData($data, 'listing_composer_relation');

			$data 		= array(
				'ProducerID'				=> $producerID,
				'ListingID' 			=> $listingID
				);
			$this->post_model->insertData($data, 'listing_producer_relation');

			$data 		= array(
				'SectionID'				=> $sectionID,
				'ListingID' 			=> $listingID
				);
			$this->post_model->insertData($data, 'listing_section_relation');

			$data 		= array(
				'WriterID'				=> $writerID,
				'ListingID' 			=> $listingID
				);
			$this->post_model->insertData($data, 'listing_writer_relation');

			$data 		= array(
				'SingerID'				=> $singerID,
				'ListingID' 			=> $listingID
				);
			if($this->post_model->insertData($data, 'listing_singer_relation')){
				echo json_encode("true");								
			}
			else{
				echo json_encode("false");
			}
		}
	}

	public function check_user_login(){
		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}

		$temp = $this->post_model->checkLoggedInUser();
		if($temp){
			echo json_encode("true");
		}
		else{
			echo json_encode("false");
		}
	}

	public function auto_complete_language(){
	    echo json_encode($this->post_model->autoSuggestion('LanguageName', 'language'));
  	}

  	public function auto_complete_Section(){
	    echo json_encode($this->post_model->autoSuggestion('SectionName', 'section'));
  	}

  	public function auto_complete_artist(){
	    echo json_encode($this->post_model->autoSuggestion('ArtistName', 'artist'));
  	}

  	public function auto_complete_singer(){
	    echo json_encode($this->post_model->autoSuggestion('SingerName', 'singer'));
  	}

  	public function auto_complete_composer(){
	    echo json_encode($this->post_model->autoSuggestion('ComposerName', 'composer'));
  	}

  	public function auto_complete_writer(){
	    echo json_encode($this->post_model->autoSuggestion('WriterName', 'writer'));
  	}

  	public function auto_complete_producer(){
	    echo json_encode($this->post_model->autoSuggestion('ProducerName', 'producer'));
  	}

	public function get_youtube_video_id(){
		$url = $this->input->post('sourceLink', TRUE);
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		echo json_encode($my_array_of_vars['v']);
	}
}
?>