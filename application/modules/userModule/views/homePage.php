
<div id=loginFormHome hidden="true">
<?php 
 	$data['mainContent'] = 'loginForm';
	$this->load->view('template', $data);
?></div>

<div id=signupFormHome hidden="true">
<?php 
 	$data['mainContent'] = 'signupForm';
	$this->load->view('template', $data);
?></div>

<div id=postFormHome hidden="true">
<?php 
 	$data['mainContent'] = 'postModule/postingPage';
	$this->load->view('template', $data);
?></div>

<div id=homePage>
	<h1 style="color: green">!!MBUDDY!!</h1>
	<button id=login type="button">Login</button>
	<button id=signup type="button">Signup</button>
	<button id=post type="button">Post</button>
</div>

<div  id=homePageL hidden="true">
<?php 
	$username = $this->session->userdata('username');
	echo "WELCOME ".$username;
	echo "<br>"; 
?>
<button id=logoutButton type="button">Logout</button>
</div>

