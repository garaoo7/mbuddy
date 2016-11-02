<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url("js/javascript.js");?>"></script>	
</head>
<body style="background-color: white">

<div id=loginForm>
<?php 
 $this->load->view('loginForm'); 
?></div>

<div id=signupForm>
<?php 
 $this->load->view('signupForm'); 
?></div>

<div id=homePage>
<h1 style="color: green">!!MBUDDY!!</h1>
<button id=login type="button">Login</button>
<button id=signup type="button">Signup</button>
</div>

</body>
</html>