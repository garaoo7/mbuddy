<?php
//birds_model.php (Array of Objects)
class Birds_model extends MY_Model{
  function get_bird($q){
    //print_r($this->db);

    $this->db->select('Username');
    $this->db->from('user');
    $this->db->like('Username',$q);
    $result = $this->db->get()->result_array();
    $data = array();
    foreach ($result as $key=> $temp) {
      $data[$key]['label'] = $temp['Username'];
      $data[$key]['value'] = $temp['Username'];
    }

    return $data;
  }
}