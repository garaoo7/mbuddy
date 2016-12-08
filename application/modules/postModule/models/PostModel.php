<?php

class PostModel extends MY_Model{

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

// 	public function dropdown(){
// 		$this->_init('read');
// 		$this->dbHandle->select('UserID, Username');
// 		$this->dbHandle->from('user');
// 		$this->dbHandle->order_by('Username');

// 		$user = $this->dbHandle->get();
// 		if($user->num_rows() > 0){
// 			$user = $user->row();
// 			return $user;
// 	}
// }
	public function checkLoggedInUser(){
//checks if the user is logged in via accessing session data.
		$username = $this->session->userdata('username');
		if(isset($username)){
			return true;
		}
		else{
			return false;
		}
	}

		public function postListing($data){ 
//inserts the new user data into database
		$this->_init('write');
		return $this->dbHandle->insert('listing', $data);
	}


}?>