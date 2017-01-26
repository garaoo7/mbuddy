<?php

class Listing_assembly_lib{

	private $listingModel;
	private $ci;
// we might do all by reference for each input in each function below
	public function __construct(){
		$this->ci =& get_instance();
	}

	public function getListingData($listingId, $status = array('live'),$sections=array('basic')){
		$listingData = false;
		if(empty($listingId)){
			return $listingData;
		}
		// $this->_validateSections($sections); //maybe
		return $this->listingModel->getListingData($listingId,$status);
	}

	public function getMultipleListingsData($listingIds, $status = array('live'),$sections){
		$listingsData = false;
		if(empty($listingIds)){ //check for array also
			return $listingsData;
		}
		// $this->_validateSections($sections); //maybe
		// if(in_array('basic', $sections) || in_array('full', $sections)){

		// }
		// $this->Getleads($listingIds)
		// if(in_array('artist', $sections) || in_array('full', $sections)){

		// }
		if($sections=='full'){

		 	$this->ci->load->builder('listing/Listing_builder');
		 	$this->ListingBuilder = new Listing_builder();
		 	$this->ListingRepository = $this->ListingBuilder->getListingRepository();
		 	$listingsObject = $this->ListingRepository->findMultiple($listingIds, 'live', 'basic');
		 	// echo '<pre>'.print_r($listingsObject,TRUE).'</pre>';

		 	$this->ci->load->builder('artist/Artist_builder');
		 	$this->ArtistBuilder = new Artist_builder();
		 	$this->ArtistRepository = $this->ArtistBuilder->getArtistRepository();
		 	$recentArtists = array('107', '108', '101');
		 	$artistsObject = $this->ArtistRepository->findMultiple($recentArtists, 'live', 'basic');
		 	// echo '<pre>'.print_r($artistsObject,TRUE).'</pre>';

		 	$this->ci->load->builder('singer/Singer_builder');
		 	$this->SingerBuilder = new Singer_builder();
		 	$this->SingerRepository = $this->SingerBuilder->getSingerRepository();
		 	$recentSingers = array('3', '4', '5');
		 	$singersObject = $this->SingerRepository->findMultiple($recentSingers, 'live', 'basic');
		 	// echo '<pre>'.print_r($singersObject,TRUE).'</pre>';
		 }

		 return $listingsObject;
		// if($sections)
	}

	
}
?>
