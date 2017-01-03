<div class="container-fluid">
<?php
  $linkData = array(
            'link1' => base_url("css/bootstrap.min.css")
            );
  $this->load->view("header", $linkData);
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
  $scriptData = array(
            'script1' => base_url("jquery/jquery-3.1.1.min.js"),
            'script2' => base_url("js/javascript.js"),
            'script3' => base_url("js/bootstrap.min.js")
            );
  $this->load->view("footer", $scriptData);
 ?>
 </div>
