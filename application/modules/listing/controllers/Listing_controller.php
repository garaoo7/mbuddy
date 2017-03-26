<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Listing_controller extends MX_Controller{

	private $listingUrl;

	public function __construct(){
		 $this->load->library('listing/listing_url');
		 $this->load->helper('url');
		 $this->listingUrl = new listing_url();

	}

	public function index($listingId=142){
		//place checks listingid validation

		$url = $this->listingUrl->ListingValidation($listingId);
		if($url == false){
			redirect(base_url('index.php/common/error_page/error'));
		}
		else if(base_url('index.php/').uri_string() != $url){
			redirect($url);
		}
		else{

			// echo "<br><br><br><br>";
			// echo $listingId;
			$this->load->builder('listing/Listing_builder');
			$this->ListingBuilder = new Listing_builder();
			$this->ListingRepository = $this->ListingBuilder->getListingRepository();
			$listingObject = $this->ListingRepository->find($listingId, array('live'), array('full'));
			$displayData['listingData'] = $listingObject;
			$this->load->view('listingPage', $displayData);
			
			//echo "<br><br><br><br>";
			//echo '<pre>'.print_r($listingObject,TRUE).'</pre>';
		}

		
	}

	public function listing(){

	}
}
?>