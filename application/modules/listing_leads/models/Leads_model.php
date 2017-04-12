<?php
	
class Leads_model extends MY_Model{
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

	public function getLeadData($lead,$leadId,$status = array('live')){

		$leadId = array($leadId);
		$data = $this->getMultipleLeadsData($lead, $leadId);
		return $data[current($leadId)];
	}

	public function getMultipleLeadsData($lead,$leadIds = array(),$status = array('live')){
		
		$this->_init('read');
		$leadsData = array();

		$this->dbHandle->select(ucwords($lead).'ID,'.ucwords($lead).'Name');

		$this->dbHandle->from($lead);

		$this->dbHandle->where_in(ucwords($lead).'ID',$leadIds);

		$this->dbHandle->where_in('Status',$status);

		$leadResults 	= $this->dbHandle->get()->result_array();
		$listingIds 	= $this->getRelatedListingIds($lead,$leadIds);
		$returnArray    = array();
		foreach ($leadResults as $key=>$leadData) {
			$returnArray[$leadData[ucwords($lead).'ID']]['basic'] = $leadData;
			if($listingIds[$leadData[ucwords($lead).'ID']]){
				$returnArray[$leadData[ucwords($lead).'ID']]['listings'] = $listingIds[$leadData[ucwords($lead).'ID']];
			}
		}	
		return $returnArray;
	}

	public function getRelatedListingIds($lead,$leadIds){
		$this->_init('read');

		$this->dbHandle->select(ucwords($lead).'ID, ListingID');
		$this->dbHandle->from('listing_'.$lead.'_relation');
		$this->dbHandle->where_in(ucwords($lead).'ID',$leadIds);
		$result_array = $this->dbHandle->get()->result_array();
		// _p($this->dbHandle->last_query());
		$returnArray = array();
		foreach ($result_array as $key => $value) {
			$returnArray[$value[ucwords($lead).'ID']][] = $value['ListingID'];
		}
		return $returnArray;
	}

	public function getLeadName($lead,$leadId,$status='live'){
		$this->_init('read');

		$this->dbHandle->select(ucwords($lead).'Name');
		$this->dbHandle->from($lead);
		$this->dbHandle->where(ucwords($lead).'ID', $leadId);
		$this->dbHandle->where('Status',$status);
		$leadName = $this->dbHandle->get();
		if($leadName->num_rows() > 0){
			$leadName = $leadName->row();
			$key = ucwords($lead).'Name';
			return $leadName->$key;
		}
		else{
			return false;
		}
		
	}
}
