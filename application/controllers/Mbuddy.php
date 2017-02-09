<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mbuddy extends MX_Controller {
	function __construct(){
		parent::__construct();
		$this->load->builder('Listing_assembly_builder','listing');
		$this->ListingAssemblyBuilder = new Listing_assembly_builder();
		$this->ListingAssemblyRepository = $this->ListingAssemblyBuilder->getListingAssemblyRepository();

		$this->userValidation = $this->check_user_validation();

	}
    public function index(){
        $recentListings = $this->get_recent_listings();
        $listingIds = array('130', '142');
        $listingsObject = $this->ListingAssemblyRepository->findMultiple($listingIds, array('live'), array('basic'));
        //echo "<br><br><br>";
        $displayData['listingsData'] = $listingsObject;
        $this->load->view('common/homepage',$displayData);//echo "<br>";echo "<br>";echo "<br>";
        // $this->load->view('common/homepage');
        //echo $listingsObject->getListingObject()[130]->getListingTitle();
        //echo '<pre>'.print_r($listingsObject,TRUE).'</pre>';
    }

    public function get_recent_listings(){

   $this->load->library('recommendations/listing_recommendations');
	   	return $this->listing_recommendations->get_recent_listings($this->userValidation);
    }
}

?>