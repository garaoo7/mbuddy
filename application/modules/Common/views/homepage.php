<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
</head>
<body>

<div id=errorHomepage hidden>
	<h3></h3>
</div>

<div id=loginFormHome hidden>
<?php 
	$this->load->view('userModule/loginForm');
?></div>

<div id=signupFormHome hidden>
<?php 
	$this->load->view('userModule/signupForm');
?></div>

<div id=postFormHome hidden>
<?php 
	$this->load->view('postModule/postingPage');
?></div>

<div id=homePageHome>
<!-- **hidden not working homePageHome div but working for rest -->
<?php 
	if($session){
		$this->load->view('loggedInUser');
	}
	else{
		$this->load->view('loggedOutUser');
	}
	
?></div>

</body>
<script src="<?php echo base_url("jquery/jquery-3.1.1.min.js");?>"></script>
<script src="<?php echo base_url("js/user/userJavascript.js");?>"></script>
</html>
