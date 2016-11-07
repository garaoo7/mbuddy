<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
		
</head>
<body style="background-color: white">

<div id=loginFormHome hidden="true">
<?php 
 $this->load->view('loginForm'); 
?></div>

<div id=signupFormHome hidden="true">
<?php 
 $this->load->view('signupForm'); 
?></div>

<div id=homePage>
<h1 style="color: green">!!MBUDDY!!</h1>
<button id=login type="button">Login</button>
<button id=signup type="button">Signup</button>
</div>
<?php
	echo '<hr>';
	$this->load->module('Nofun/nofunsss');
	$this->nofunsss->sayhello();
?>


</body>
<script src="<?php echo base_url("jquery/jquery-3.1.1.min.js");?>"></script>
<script src="<?php echo base_url("js/javascript.js");?>"></script>
</html>
