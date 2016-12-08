<?php

class Posting extends MX_Controller{

	public function __construct(){
		$this->load->model("postModel");
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
        $artist 		= 	$this->input->post('artist', TRUE);
        $composer 		= 	$this->input->post('composer', TRUE);
        $writer 		= 	$this->input->post('writer', TRUE);
       		
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
	   	if($artist == null || $artist == ""){
	  		echo json_encode("Artist field can not be empty");
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
}
?>