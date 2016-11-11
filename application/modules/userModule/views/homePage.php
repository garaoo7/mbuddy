
<div id=loginFormHome hidden="true">
<?php 
 	$data['mainContent'] = 'loginForm';
	$this->load->view('includes/template', $data);
?></div>

<div id=signupFormHome hidden="true">
<?php 
 	$data['mainContent'] = 'signupForm';
	$this->load->view('includes/template', $data);
?></div>

<div id=homePage>
	<h1 style="color: green">!!MBUDDY!!</h1>
	<button id=login type="button">Login</button>
	<button id=signup type="button">Signup</button>
</div>

<div  id=homePageL style="display: none;">
<?php 
	$username = $this->session->userdata('username');
	echo "WELCOME ".$username;
	echo "<br>"; 
?>
<button id=logoutButton type="button">Logout</button>
</div>

