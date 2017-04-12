<?php
	
class Tag_model extends MY_Model{
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

	public function getTagData($tagId,$status = array('live')){
		$tagId = array($tagId);
		$data = $this->getMultipleTagsData($tagId);
		return $data[current($tagId)];
	}

	public function getMultipleTagsData($tagIds = array(),$status = array('live')){
		$this->_init('read');

		$this->dbHandle->select('	TagID,
								 	TagName,
									TagCreatedBy, 
									TagCreationDate
								'
								);

		$this->dbHandle->from('tag');

		$this->dbHandle->where_in('TagID',$tagIds);

		$this->dbHandle->where_in('Status',$status);

		$tagResults = $this->dbHandle->get()->result_array();
		$listingIds   = $this->getListingIds($tagIds);
		$returnArray    = array();
		foreach ($tagResults as $key=>$tagData) {
			$returnArray[$tagData['TagID']]['basic'] = $tagData;
			if($listingIds[$tagData['TagID']]){
				$returnArray[$tagData['TagID']]['listings'] = $listingIds[$tagData['TagID']];
			}
		}
		return $returnArray;
	}

	public function getListingIds($tagIds){
		$this->_init('read');

		$this->dbHandle->select('ListingID,TagID');
		$this->dbHandle->from('listing_tag_relation');
		$this->dbHandle->where_in('TagID',$tagIds);
		$result_array = $this->dbHandle->get()->result_array();
		// _p($this->dbHandle->last_query());
		$returnArray = array();
		foreach ($result_array as $key => $value) {
			$returnArray[$value['TagID']][] = $value['ListingID'];
		}
		return $returnArray;
	}

	public function getTagName($tagId,$status='live'){
		$this->_init('read');
		$this->dbHandle->select('TagName');
		$this->dbHandle->from('tag');
		$this->dbHandle->where('TagID', $tagId);
		$this->dbHandle->where('Status',$status);
		$tagName = $this->dbHandle->get();
		if($tagName->num_rows() > 0){
			$tagName = $tagName->row();
			return $tagName->TagName;
		}
		else{
			return false;
		}
		
	}
}
