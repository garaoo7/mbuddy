<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leads_controller extends MX_Controller{

	private $leadsUrl;

	public function __construct(){
		 $this->load->library('listing_leads/leads_url');
		 $this->load->builder('listing_leads/Leads_builder');
		 $this->LeadsBuilder = new Leads_builder();
		 $this->LeadsRepository = $this->LeadsBuilder->getLeadsRepository();
		 $this->load->helper('url');
		 $this->leadsUrl = new leads_url();

	}

	public function index($key, $temp, $leadId){
		//place checks singerid validation
		// if($key = 'singer'){
			$url = $this->leadsUrl->getLeadUrl($key,$leadId);
			if($url == false){
				show_error_page();
			}
			else if(getRelativeUrl() != $url){
				redirect(MBUDDY_HOME.$url);
			}
			else{
				$leadObject = $this->LeadsRepository->find($key,$leadId,array('full'));
				$displayData['leadData'] = $leadObject;
				_p($leadObject);
				die;
				$this->load->view('singerPage', $displayData);
				
				echo "<br><br><br><br>";
				//echo '<pre>'.print_r($singerObject,TRUE).'</pre>';
			// }
		}
		
	}


	// public function get_more_singers(){
	// 	$this->load->library('recommendations/singer_recommendations');
	//     $offset = $this->input->post('offset');
	//     $singerIds = $this->singer_recommendations->get_more_singers($this->userValidation, $offset);

	//     $singersObject = $this->singerRepository->findMultiple($singerIds);

	//     $displayData['singersData'] = $singersObject;
	//     $data = $this->load->view('common/loadMoreTemp',$displayData, TRUE);
	//     echo json_encode($data);
	//     return;

	//}
}
?>