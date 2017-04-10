<?php
	
class Singer_model extends MY_Model{
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

	public function getSingerData($singerId,$status = array('live')){

		$singerId = array($singerId);
		$data = $this->getMultipleSingersData($singerId);
		return $data[current($singerId)];
	}

	public function getMultipleSingersData($singerIds = array(),$status = array('live')){

		$this->_init('read');
		$singersData = array();

		$this->dbHandle->select('	SingerID,
								 	SingerName
								'
								);

		$this->dbHandle->from('singer');

		$this->dbHandle->where_in('SingerID',$singerIds);

		$this->dbHandle->where_in('Status',$status);


		$singerResults 	= $this->dbHandle->get()->result_array();
		$listingIds 	= $this->getRelatedListingIds($singerIds);
		$returnArray    = array();
		foreach ($singerResults as $key=>$singerData) {
			$returnArray[$singerData['SingerID']]['basic'] = $singerData;
			if($listingIds[$singerData['SingerID']]){
				$returnArray[$singerData['SingerID']]['listings'] 		= $listingIds[$singerData['SingerID']];
			}
		}	
		return $returnArray;
	}

	public function getRelatedListingIds($singerIds){
		$this->_init('read');

		$this->dbHandle->select('SingerID, ListingID');
		$this->dbHandle->from('listing_singer_relation');
		$this->dbHandle->where_in('SingerID',$singerIds);
		$result_array = $this->dbHandle->get()->result_array();
		// _p($this->dbHandle->last_query());
		$returnArray = array();
		foreach ($result_array as $key => $value) {
			$returnArray[$value['SingerID']][] = $value['ListingID'];
		}
		return $returnArray;
	}

	public function getSingerName($singerId,$status='live'){
		$this->_init('read');

		$this->dbHandle->select('SingerName');
		$this->dbHandle->from('singer');
		$this->dbHandle->where('SingerID', $singerId);
		$this->dbHandle->where('Status',$status);
		$singerName = $this->dbHandle->get();
		if($singerName->num_rows() > 0){
			$singerName = $singerName->row();
			return $singerName->SingerName;
		}
		else{
			return false;
		}
		
	}
}
