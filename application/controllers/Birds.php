





<?php
//birds.php
class Birds extends CI_Controller{
  public function index(){
    $this->load->view('Post/birds_View');
  }
 
  function get_birds(){
    $this->load->model('birds_model');
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->birds_model->get_bird($q);
    }
  }
}
?>