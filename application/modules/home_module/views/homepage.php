
<?php
  $linkData = array(
            'css' => array("http://localhost/mbuddy/css/bootstrap.min.css", "http://localhost/mbuddy/css/style.css")
            );
  $this->load->view("common/header", $linkData);
 ?>



<?php
  $scriptData = array(
            'js' => array("http://localhost/mbuddy/jquery/jquery-3.1.1.min.js", "http://localhost/mbuddy/js/javascript.js", "http://localhost/mbuddy/js/bootstrap.min.js")
            );
  $this->load->view("common/footer", $scriptData);
 ?>
