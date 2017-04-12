<?php

class Leads_lib{

	private $leadsModel;
	private $ci;
// we might do call by reference for each input in each function below
	public function __construct($leadsModel){
		if(!empty($leadsModel)){
			$this->leadsModel = $leadsModel;
		}
		$this->ci =& get_instance();
	}

	public function getSectionWiseLeadData($lead,$leadId){
		$leadData = false;
		if(empty($leadId)){
			return $leadData;
		}

		return $this->leadsModel->getLeadData($lead,$leadId);
	}

	public function getSectionWiseMultipleLeadsData($lead,$leadIds){
		$leadsData = false;
		if(empty($leadIds) || !is_array($leadIds) || count($leadIds)==0){ //
			return $leadsData;
		}
		return $this->leadsModel->getMultipleLeadsData($lead,$leadIds);
	}	

	public function getRelatedIds($leadIds, $key){
		return $this->leadModel->getRelatedIds($leadIds, $key);
	}
}
?>
