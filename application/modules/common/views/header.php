<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>	
	<?php
	foreach ($css as $value) {
		echo "<link href=".$value." rel="."'stylesheet'>";
	}
	?>
</head>
<body>
	<div class="container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-md-2">
					<a href="<?php echo base_url("index.php/home_module/home/index") ?>"><h1>!!MBUDDY!!</h1></a>
				</div>
				<div class="col-md-7">
					<input type="text" id="searchBar" placeholder="Search..">
				</div>
				<div class="col-md-3">
					<div id=homePageHome>
						<?php 
						if($this->session->userID){
							$username = $this->session->userdata('username');
							echo "WELCOME ".$username;
							echo "<div>
							<button id=logoutButton type='button' class='btn btn-default'>Logout</button>
							<button id=postButton type='button' class='btn btn-default'>Post</button>
							</div>";
						}
						else{
							echo "<div>
							<button type='button' class='btn btn-default' id='loginButton'>Login</button>
							<button type='button' class='btn btn-default' id='signupButton'>Signup</button>
							<button type='button' class='btn btn-default' id=postButton>Post</button>
							</div>";
						}
						?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3 col-md-offset-9">
					<div id=errorHomepage hidden>
						<h3></h3>
					</div>
				</div>
			</div>
		</div>

	<?php 
	$this->load->view('user_module/loginForm');
	?>
	<?php 
	$this->load->view('user_module/signupForm');
	?>
	

