<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


// class Artist_controller extends MX_Controller{

// 	public function index($listingId=1){

// 		$this->load->builder('artist/Artist_builder');
// 		$this->ArtistBuilder = new Artist_builder();
// 		$this->ArtistRepository = $this->ArtistBuilder->getArtistRepository();
// 		$artistIds = array('107', '108', '101');//take ids as input
// 		$artistObjects = $this->ArtistRepository->findMultiple($artistIds, 'live', array('basic'));
// 		echo '<pre>'.print_r($artistObjects,TRUE).'</pre>';
// 		echo "string";

// 		$this->load->builder('listing/Listing_builder');
// 		$ListingBuilder = new Listing_builder();
// 		$ListingRepository = $ListingBuilder->getListingRepository();
// 		$listingIds = array(142, 145, 130);//send recieved listing ids from artist as input
// 		$listingObjects = $ListingRepository->findMultiple($listingIds);
// 		echo '<pre>'.print_r($listingObjects,TRUE).'</pre>';


// 	}
// }



  ?>