<?php

class Leads_url {

	private $ci;
	private $leadsModel;

	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model("listing_leads/leads_model");
		$this->leadsModel = new leads_model();
	}
//url_builder lib name
	//validate_url for below function

	public function getLeadUrl($lead,$leadId){
		//validate the lead for the given leadId
		$leadName = $this->leadsModel->getLeadName($lead,$leadId);
		if($leadName == false){
			return false;
		}
		else{
			$url = convertTextToUrl($leadName);
			return "$lead/"."$url/$leadId";
		}

	}
}

?>