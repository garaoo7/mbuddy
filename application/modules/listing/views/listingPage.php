
<?php
  $headerComponents = array(
							'css' => array("common/bootstrap.min.css", "style.css")
							);
  $this->load->view("common/header2", $headerComponents);
  // $this->load->view("common/feedelement");
?>

<h1>heya!!</h1>
<img src="<?php echo base_url('css/images/cards.jpg')?>" height='300px' width='500px'>
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
