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

		$url = $this->listingUrl->getListingUrl($listingId);
		if($url == false){
			show_error_page();
		}
		else if(getRelativeUrl() != $url){
			redirect(MBUDDY_HOME.$url);
		}
		else{
			$this->load->builder('listing/Listing_builder');
			$this->ListingBuilder = new Listing_builder();
			$this->ListingRepository = $this->ListingBuilder->getListingRepository();
			$listingObject = $this->ListingRepository->find($listingId,array('full'));
			$displayData['listingData'] = $listingObject;
			
			$this->load->view('listingPage', $displayData);
			
			echo "<br><br><br><br>";
			//echo '<pre>'.print_r($listingObject,TRUE).'</pre>';
		}

		
	}

	public function listing(){

	}
}
?>