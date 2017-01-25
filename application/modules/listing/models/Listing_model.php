<?php
	
class Listing_model extends MY_Model{
// we might do call by reference for each input in each function below
	private $dbHandle;
	private function _init($handle = 'read'){
		if($handle=='read'){
			$this->dbHandle = $this->getReadHandle();
		}
		else if($handle=='write'){
			$this->dbHandle = $this->getWriteHandle();
		}
	}

	public function getListingData($listingId,$status = array('live'),$sections=array('basic')){

		/*$this->_init('read');
		
		$this->dbHandle->select('ListingTitle,ListingViews');

		$this->dbHandle->from('listing');

		$this->dbHandle->where('ListingID',$listingId);

		$this->dbHandle->where_in('Status',$status);

		$listingData = $this->dbHandle->get()->result_array();
		echo $this->dbHandle->last_query();
		print_r($listingData);
		return $listingData[0];
		*/
		//creating temp return data, data should be fetched according to above logic
		$listingData['ListingTitle'] = 'Papa';
		$listingData['ListingViews'] = '1000';
		return $listingData;
	}

	public function getMultipleListingsData($listingIds = array(),$status = array('live'),$sections=array('basic')){

		$this->_init('read');
		$listingsData = array();

		if(array_search("basic",$sections) >= 0){
			$this->dbHandle->select('listing.ListingID,listing.ListingTitle,listing.ListingViews,user.Username');

			$this->dbHandle->from('listing');

			$this->dbHandle->where_in('listing.ListingID',$listingIds);

			$this->dbHandle->where_in('listing.Status',$status);

			$this->dbHandle->join('user', 'user.UserID = listing.UserID');

			$listingResults = $this->dbHandle->get()->result_array();

			foreach ($listingResults as $listingResult){
				$listingsData[$listingResult['ListingID']]['ListingTitle'] = $listingResult['ListingTitle'];
				$listingsData[$listingResult['ListingID']]['ListingViews'] = $listingResult['ListingViews'];
				$listingsData[$listingResult['ListingID']]['Username'] = $listingResult['Username'];
			}
		}

		if(array_search("full",$sections) >= 0){
			$this->dbHandle->select('listing.ListingID,ListingTitle,ListingViews,user.Username, ArtistName,LanguageName');

			$this->dbHandle->from('listing');

			$this->dbHandle->where_in('listing.ListingID',$listingIds);

			$this->dbHandle->where_in('listing.Status',$status);


			$this->dbHandle->join('listing_artist_relation', 'listing_artist_relation.ListingID = listing.ListingID');

			$this->dbHandle->join('artist', 'artist.ArtistID = listing_artist_relation.ArtistID');

			$this->dbHandle->join('listing_language_relation', 'listing_language_relation.ListingID = listing.ListingID');

			$this->dbHandle->join('language', 'language.LanguageID = listing_language_relation.LanguageID');

			$this->dbHandle->join('user', 'user.UserID = listing.UserID');

			// $listingss = $this->dbHandle->get();
			// $listingResults = $listingss->result_array();
			// $listingResults = $this->dbHandle->get()->result_array();

			// echo $this->dbHandle->last_query();
			// die();

			foreach ($listingResults as $listingResult){
				$listingsData[$listingResult['ListingID']]['ListingTitle'] = $listingResult['ListingTitle'];
				$listingsData[$listingResult['ListingID']]['ListingViews'] = $listingResult['ListingViews'];
				$listingsData[$listingResult['ListingID']]['Username'] = $listingResult['Username'];
				$listingsData[$listingResult['ListingID']]['ArtistName'] = $listingResult['ArtistName'];
				$listingsData[$listingResult['ListingID']]['LanguageName'] = $listingResult['LanguageName'];
				// $listingsData[$listingResult['ListingID']]['numRows'] = $listingss->num_rows();
			}
		}

		// echo $this->dbHandle->last_query();
		// print_r($listingResults);
		// return $listingData[0];
		
		//creating temp return data, data should be fetched according to above logic, query will be needed to get changed.
		return $listingsData;
	}
}
