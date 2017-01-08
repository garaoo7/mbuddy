
<?php
  $headerComponents = array(
            		   'css' => array("common/bootstrap.min.css", "style.css")
            	      );
  $this->load->view("common/header2", $headerComponents);
  $this->load->view("common/feedelement");
?>


<?php
  $footerComponents = array(
            		 	'js' => array(
            		 				  "common/jquery-3.1.1.min.js", 
            		 				  "common/header.js", 
            		 				  "common/bootstrap.min.js"
            		 				  )
           			  );
  $this->load->view("common/footer", $footerComponents);
 ?>
