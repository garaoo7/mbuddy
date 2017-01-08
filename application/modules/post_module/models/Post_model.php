<?php

class Post_model extends MY_Model{

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

	public function entryExist($value, $coloumn, $table){
//check if a entry exists in the particular table in the database and returns the row entry if it exists
		$this->_init('read');
		$this->dbHandle->from($table);
		$this->dbHandle->where($coloumn, $value);
		$entry = $this->dbHandle->get();
		if($entry->num_rows() > 0){
			$entry = $entry->row();
			return $entry;
		}
		//echo $this->dbHandle->last_query();
		return false;
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

	public function insertData($data){ 
//inserts the new user data into database
		//**not rolling back
		$this->_init('write');
		$this->dbHandle->trans_start();
		$this->dbHandle->insert('listing', $data['listingData']);
		$this->dbHandle->insert_batch('language', $data['languageData']);
		$this->dbHandle->insert_batch('section', $data['sectionData']);
		$this->dbHandle->insert_batch('artist', $data['artistData']);
		$this->dbHandle->insert_batch('singer', $data)['singerData'];
		$this->dbHandle->insert_batch('composer', $data['composerData']);
		$this->dbHandle->insert_batch('writer', $data['writerData']);
		$this->dbHandle->insert_batch('producer', $data['producerData']);
		$this->dbHandle->insert('temporary_listing_data', $data['invalidData']);
		$this->dbHandle->trans_complete();
		return $this->dbHandle->trans_status();
	}

  function autoSuggestion($coloumn2, $table, $coloumn1 = null){
    //print_r($this->db);
    if($coloumn1 == null){
    	$coloumn1 = $coloumn2;
    }
	    $this->db->select($coloumn1);
	    $this->db->select($coloumn2);
	    $this->db->from($table);
	    $result = $this->db->get()->result_array();
	    $data = array();
	    // $i = 0;	
	    foreach ($result as $key=> $temp) {
	      	$data[$key]['key'] = $temp[$coloumn1];
      		$data[$key]['value'] = $temp[$coloumn2];
      		// $i++;
	    }

	    return $data;
  }

//array(1,2,3,4,'custom'=>array("cool","nice"));

  
}?>

