<div class="container-fluid">
<?php
  $this->load->view("header");
 ?>

<div id=errorHomepage hidden>
	<h3></h3>
</div>

<div id=loginFormHome hidden>
<?php 
	$this->load->view('user_module/loginForm');
?></div>

<div id=signupFormHome hidden>
<?php 
	$this->load->view('user_module/signupForm');
?></div>

<div id=homePageHome>

<?php 
	if($session){
		$this->load->view('loggedInUser');
	}
	else{
		$this->load->view('loggedOutUser');
	}
	
?></div>
<?php
  $this->load->view("footer");
 ?>
 </div>
