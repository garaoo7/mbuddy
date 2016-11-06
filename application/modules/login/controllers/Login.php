<?php 

class Login extends MX_Controller {

	public function index()
	{
		$data['main_content']='login_form';
		$this->load->view('includes/template', $data);
	}

	function validate_credentials()
	{
		$this->load->model('Membership_model');
		$query = $this->Membership_model->validate();

		if($query){

			$data = array(
				'username' =>$this->input->post('username'),
				'is_logged_in' => true
			);

			$this->session->set_userdata($data);
			redirect('login/site/members_area');
		}

		else{
			$this->index();
		}
	}

	function signup(){

		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);
	}

	function create_member(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->form_validation->run() == FALSE){
			$this->signup();
		}
		else{
			$this->db->trans_start();
			$this->load->model('membership_model');
			if($query = $this->membership_model->create_member()){
				$data['main_content'] = 'signup_successful';
			$this->db->trans_complete();
				$this->load->view('includes/template', $data);
			}
			else{
				$this->load->view('signup_form');
			}
		}
	}
}
?>