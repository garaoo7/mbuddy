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

	public function getMultipleListingsData($listingIds,$status = array('live'),$sections=array('basic')){

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
		//creating temp return data, data should be fetched according to above logic, query will be needed to get changed.
		$listingsData = array();
		foreach ($listingIds as $listingId) {
			$listingsData[$listingId]['ListingTitle'] = 'Papa';
			$listingsData[$listingId]['ListingViews'] = '1000';
		}
		return $listingsData;
	}
}
