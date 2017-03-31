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

	public function getSingerData($singerId,$status = array('live'),$sections= 'basic'){

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
		$singerData['singerName'] = 'Papa';
		$singerData['singerID'] = '1000';
		return $singerData;
	}

	public function getMultipleSingersData($singerIds = array(),$status = array('live'),$sections='basic'){

		$this->_init('read');
		$singersData = array();

		if($sections == 'basic'){
		 	$this->dbHandle->select('SingerName, SingerID');

		 	$this->dbHandle->from('singer');

		 	$this->dbHandle->where_in('SingerID',$singerIds);

		 	$this->dbHandle->where_in('Status',$status);

		// 	$this->dbHandle->join('user', 'user.UserID = listing.UserID');

			$singerResults = $this->dbHandle->get()->result_array();

		 	foreach ($singerResults as $singerResult){
		 		$singersData[$singerResult['SingerID']]['SingerID'] = $singerResult['SingerID'];
		 		$singersData[$singerResult['SingerID']]['SingerName'] = $singerResult['SingerName'];
		 	}
		}

		// echo $this->dbHandle->last_query();
		// print_r($listingResults);
		// return $listingData[0];
		// foreach ($singerIds as $singerId) {
		// 	$singersData[$singerId]['singerName'] = 'Papa';
		// 	$singersData[$singerId]['singerID'] = '1000';
		// }
		//creating temp return data, data should be fetched according to above logic, query will be needed to get changed.
		return $singersData;
	}
}
