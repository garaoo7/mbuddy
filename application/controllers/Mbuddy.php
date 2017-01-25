<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mbuddy extends MX_Controller {
	function __construct(){
		parent::__construct();
		$this->load->builder('Listing_builder','listing');
		$this->ListingBuilder = new Listing_builder();
		$this->ListingRepository = $this->ListingBuilder->getListingRepository();

		$this->userValidation = $this->check_user_validation();

	}
    public function index(){
        $recentListings = $this->get_recent_listings(0,20);
        $listingsObject = $this->ListingRepository->findMultiple($recentListings, 'live', 'full');
        // echo "<br>";
        $displayData['listingData'] = $listingsObject;
        $this->load->view('common/homepage',$displayData);
        // $this->load->view('common/homepage');
        echo '<pre>'.print_r($listingsObject,TRUE).'</pre>';
    }

    public function get_recent_listings(){

   $this->load->library('recommendations/listing_recommendations');
	   	return $this->listing_recommendations->get_recent_listings($this->userValidation);
    }
}

?>