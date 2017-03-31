<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mbuddy extends MX_Controller {
	function __construct(){
		parent::__construct();
        	$this->load->library('recommendations/listing_recommendations');
		$this->load->builder('Listing_builder','listing');
		$this->ListingBuilder = new Listing_builder();
		$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		$this->userValidation = $this->check_user_validation();

	}
    public function index(){
        $recentListings = $this->get_recent_listings();
        $listingIds = array('130', '142');
        $listingsObject = $this->ListingRepository->findMultiple($recentListings, array('live'), array('basic'));
        //echo "<br><br><br>";
        $displayData['listingsData'] = $listingsObject;
        $this->load->view('common/homepage',$displayData);//echo "<br>";echo "<br>";echo "<br>";
        // $this->load->view('common/homepage');
        //echo $listingsObject->getListingObject()[130]->getListingTitle();
        //echo '<pre>'.print_r($listingsObject,TRUE).'</pre>';
    }

    public function get_recent_listings(){
	   	return $this->listing_recommendations->get_recent_listings($this->userValidation);
    }

    public function get_more_listings(){
        $offset = $this->input->post('offset');
        $listingIds = $this->listing_recommendations->get_more_listings($this->userValidation, $offset);
        $listingsObject = $this->ListingRepository->findMultiple($listingIds, array('live'), array('basic'));
        $displayData['listingsData'] = $listingsObject;
        $data = $this->load->view('common/loadMoreTemp',$displayData, TRUE);
        echo json_encode($data);
        return;

    }
}

?>