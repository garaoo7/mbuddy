<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Singer_controller extends MX_Controller{

	private $singerUrl;

	public function __construct(){
		 $this->load->library('singer/singer_url');
		 $this->load->builder('singer/Singer_builder');
		 $this->SingerBuilder = new Singer_builder();
		 $this->SingerRepository = $this->SingerBuilder->getSingerRepository();
		 $this->load->helper('url');
		 $this->singerUrl = new singer_url();

	}

	public function index($singerId){
		// echo $singerId;
		// die;
		//place checks singerid validation

		$url = $this->singerUrl->getSingerUrl($singerId);
		if($url == false){
			show_error_page();
		}
		else if(getRelativeUrl() != $url){
			redirect(MBUDDY_HOME.$url);
		}
		else{
			$singerObject = $this->SingerRepository->find($singerId,array('full'));
			$displayData['singerData'] = $singerObject;
			 _p($singerObject);
			 die;
			$this->load->view('singerPage', $displayData);
			
			echo "<br><br><br><br>";
			//echo '<pre>'.print_r($singerObject,TRUE).'</pre>';
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