<?php
//birds_model.php (Array of Objects)
class Birds_model extends CI_Model{
  function get_bird($q){
    $this->db->select('*');
    $this->db->like('bird', $q);
    $query = $this->db->get('birds');
    if($query->num_rows() > 0){
      foreach ($query->result_array() as $row){
        $new_row['label']=htmlentities(stripslashes($row['bird']));
        $new_row['value']=htmlentities(stripslashes($row['aka']));
        $row_set[] = $new_row; //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }
}