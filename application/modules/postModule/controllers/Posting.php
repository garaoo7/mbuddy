<?php

class Posting extends MX_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("postModel");
		$this->load->helper('security');

	}

	public function index(){
		$this->load->view('postingPage');

	}

	public function postListing(){
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
			$this->load->module('Common/ticketgenerator');

			$artistTemp = $this->postModel->entryExist($artist, 'ArtistName', 'artist');
			if($artistTemp){
				$artistID = $artistTemp->ArtistID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$artistID = $this->ticketgenerator->generateTicketArtist();
			// 	$artistData = array(
			// 		'ArtistID' => $artistID,
			// 		'ArtistName' => $artist
			// 		);
			// 	$this->postModel->insertData($artistData, 'artist');
			// }

			$composerTemp = $this->postModel->entryExist($composer, 'ComposerName', 'composer');
			if($composerTemp){
				$composerID = $composerTemp->ComposerID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$composerID = $this->ticketgenerator->generateTicketComposer();
			// 	$composerData = array(
			// 		'ComposerID' => $composerID,
			// 		'ComposerName' => $composer
			// 		);
			// 	$this->postModel->insertData($composerData, 'composer');
			// }

			$producerTemp = $this->postModel->entryExist($producer, 'ProducerName', 'producer');
			if($producerTemp){
				$producerID = $producerTemp->ProducerID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$producerID = $this->ticketgenerator->generateTicketProducer();
			// 	$producerData = array(
			// 		'ProducerID' => $producerID,
			// 		'ProducerName' => $producer
			// 		);
			// 	$this->postModel->insertData($producerData, 'producer');
			// }

			$sectionTemp = $this->postModel->entryExist($section, 'SectionName', 'section');
			if($sectionTemp){
				$sectionID = $sectionTemp->SectionID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$sectionID = $this->ticketgenerator->generateTicketSection();
			// 	$sectionData = array(
			// 		'SectionID' => $sectionID,
			// 		'SectionName' => $section
			// 		);
			// 	$this->postModel->insertData($sectionData, 'section');
			// }

			$writerTemp = $this->postModel->entryExist($writer, 'WriterName', 'writer');
			if($writerTemp){
				$writerID = $writerTemp->WriterID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$writerID = $this->ticketgenerator->generateTicketWriter();
			// 	$writerData = array(
			// 		'WriterID' => $writerID,
			// 		'WriterName' => $writer
			// 		);
			// 	$this->postModel->insertData($writerData, 'writer');
			// }

			$singerTemp = $this->postModel->entryExist($singer, 'SingerName', 'singer');
			if($singerTemp){
				$singerID = $singerTemp->SingerID;
			}
			else{
				echo json_encode("false");
				return false;
			}
			// else{
			// 	$singerID = $this->ticketgenerator->generateTicketSinger();
			// 	$singerData = array(
			// 		'SingerID' => $singerID,
			// 		'SingerName' => $singer
			// 		);
			// 	$this->postModel->insertData($singerData, 'singer');
			// }

			$listingID  = $this->ticketgenerator->generateTicketListing();
			$userID 	= $this->session->userdata('userID');
			$data 		= array(
				'UserID'				=> $userID,
				'ListingID' 			=> $listingID,
				'ListingTitle'			=> $title,
				'ListingDescription' 	=> $description,
				'ListingSourceLink' 	=> $sourceLink,
				);
			$this->postModel->insertData($data, 'listing');

			$data 		= array(
				'ArtistID'				=> $artistID,
				'ListingID' 			=> $listingID
				);
			$this->postModel->insertData($data, 'listing_artist_relation');

			$data 		= array(
				'ComposerID'				=> $composerID,
				'ListingID' 			=> $listingID
				);
			$this->postModel->insertData($data, 'listing_composer_relation');

			$data 		= array(
				'ProducerID'				=> $producerID,
				'ListingID' 			=> $listingID
				);
			$this->postModel->insertData($data, 'listing_producer_relation');

			$data 		= array(
				'SectionID'				=> $sectionID,
				'ListingID' 			=> $listingID
				);
			$this->postModel->insertData($data, 'listing_section_relation');

			$data 		= array(
				'WriterID'				=> $writerID,
				'ListingID' 			=> $listingID
				);
			$this->postModel->insertData($data, 'listing_writer_relation');

			$data 		= array(
				'SingerID'				=> $singerID,
				'ListingID' 			=> $listingID
				);
			if($this->postModel->insertData($data, 'listing_singer_relation')){
				echo json_encode("true");								
			}
			else{
				echo json_encode("false");
			}
		}
	}

	public function checkUserLogin(){
		if (!$this->input->is_ajax_request()) {
   			exit('No direct script access allowed');
		}

		$temp = $this->postModel->checkLoggedInUser();
		if($temp){
			echo json_encode("true");
		}
		else{
			echo json_encode("false");
		}
	}

	// public function autoCompleteLanguage(){
	//     if (isset($_GET['term'])){
	//       $q = strtolower($_GET['term']);
	//       echo json_encode($this->postModel->autoSuggestion($q));
	//     }
 //  	}

  	public function autoCompleteSection(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);
	      echo json_encode($this->postModel->autoSuggestion($q, 'SectionName', 'section'));
	    }
  	}

  	public function autoCompleteArtist(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);
	      echo json_encode($this->postModel->autoSuggestion($q, 'ArtistName', 'artist'));
	    }
  	}

  	public function autoCompleteSinger(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);
	      echo json_encode($this->postModel->autoSuggestion($q, 'SingerName', 'singer'));
	    }
  	}

  	public function autoCompleteComposer(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);
	      echo json_encode($this->postModel->autoSuggestion($q, 'ComposerName', 'composer'));
	    }
  	}

  	public function autoCompleteWriter(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);
	      echo json_encode($this->postModel->autoSuggestion($q, 'WriterName', 'writer'));
	    }
  	}

  	public function autoCompleteProducer(){
	    if (isset($_GET['term'])){
	      $q = strtolower($_GET['term']);
	      echo json_encode($this->postModel->autoSuggestion($q, 'ProducerName', 'producer'));
	    }
  	}

	public function getYoutubeVideoId(){
		$url = $this->input->post('sourceLink', TRUE);
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		echo json_encode($my_array_of_vars['v']);   

	}
}
?>