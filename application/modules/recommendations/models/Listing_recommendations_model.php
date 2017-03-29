<?php

class Listing_recommendations_model extends MY_Model{

	private $dbHandle;
	private function _init($handle = 'read'){
	//directs the database requests to specific servers(hostnames), different for read and write.
		if($handle=='read'){
			$this->dbHandle = $this->getReadHandle();
		}
		else if($handle=='write'){
			$this->dbHandle = $this->getWriteHandle();
		}
	}


	public function get_more_listings($userValidation, $offset){
		// if(!$userValidation)
		// 	return array();
		$arrayID = array();
		$this->_init('read');
		$this->dbHandle->select('ListingID');
		$this->dbHandle->from('listing');
		$this->dbHandle->limit(1, $offset);

		$listingIds = $this->dbHandle->get();
		if($listingIds->num_rows() > 0){
			$listingIds = $listingIds->result_array();
			foreach ($listingIds as $listingId){
				array_push($arrayID, $listingId['ListingID']);
			}
			return $arrayID;
		}
		return false;
	}

	public function get_recent_listings($userValidation){
		// if(!$userValidation)
		// 	return array();
		$arrayID = array();
		$this->_init('read');
		$this->dbHandle->select('ListingID');
		$this->dbHandle->from('listing');
		$this->dbHandle->limit(3);

		$listingIds = $this->dbHandle->get();
		if($listingIds->num_rows() > 0){
			$listingIds = $listingIds->result_array();
			foreach ($listingIds as $listingId){
				array_push($arrayID, $listingId['ListingID']);
			}
			return $arrayID;
		}
		return false;

	}

	public function get_recent_artists($userValidation){
		if(!$userValidation)
			return array();
		return array('107', '108', '101');

	}
  }

//array(1,2,3,4,'custom'=>array("cool","nice"));
?>

