





<?php
//birds.php
class Birds extends CI_Controller{
  public function index(){
    $this->load->view('Post/birds_View');
  }
 
  function get_birds(){
    $this->load->model('Birds_model');
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      echo json_encode($this->Birds_model->get_bird($q));
    }
  }
}
?>