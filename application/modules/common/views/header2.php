<!DOCTYPE html>
<html lang="en">
<head>
	<title>mbuddy</title>
	<?php
	foreach ($css as $value) {
		echo "<link href=".base_url('/css/'.$value)." rel="."'stylesheet'>";
	}
	?>
	<style>
	</style>
</head>
<body>
	<div class="container-fluid">
	<div id="wrapper">
		<div id="header">
			<nav class="navbar navbar-fixed-top navbar-default "  role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo base_url();?>">mBuddy</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="navbar-collapse-1">
					<div class="col-sm-6 col-md-6">
						<form class="navbar-form" id="searchBoxForm">
							<div class="input-group">
								<input id="searchBox" type="text" class="form-control searchBox" placeholder="Search" name="q">
								<div class="input-group-btn">
									<button class="btn btn-success " type="submit"  ><i class="glyphicon glyphicon-search"></i></button>
								</div>

							</div>
						</form>
					</div>
					<ul class="nav navbar-nav navbar-right" style="margin-right:50px">
						<?php 
						if($this->session->userdata('username')){
							?><li><a id=postButton href="javascript:void(0)">Post</a></li><?php 
						}?>
						<li><a href="#">About</a></li>
						<?php
						if(!$this->session->userdata('username')) {
							?>
							<li><a href="javascript:void(0)" id='loginButton'>Log In/Sign Up</a></li> </ul>
							<?php 
							}  
							else{?>
							<li>
								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<span class="glyphicon glyphicon-user"></span> 
											<strong><?php echo $this->session->userdata('username');?></strong>
											<span class="glyphicon glyphicon-chevron-down"></span>
										</a>
										<ul class="dropdown-menu">
											<li>
												<div class="navbar-login navbar-login-session">
													<div class="row">
														<div class="col-lg-10">
															<a href="#" class="btn btn-block">Profile</a>
														</div>
													</div>
												</div>
											</li>
											<li class="divider"></li>
											<li>
												<div class="navbar-login navbar-login-session">
													<div class="row">
														<div class="col-lg-10">
															<a href="#" class="btn btn-block">Activity</a>
														</div>
													</div>
												</div>
											</li>
											<li class="divider"></li>
											<li>
												<div class="navbar-login navbar-login-session">
													<div class="row">
														<div class="col-lg-10">
															<a href="#" class="btn btn-block">Change Password</a>
														</div>
													</div>
												</div>
											</li>
											<li class="divider"></li>
											<li>
												<div class="navbar-login navbar-login-session">
													<div class="row">
														<div class="col-lg-10">

															<a href="javascript:void(0)" id="logoutButton" class="btn btn-block">Logout</a>

														</div>
													</div>
												</div>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>

						<?php }?>
				</div><!-- /.navbar-collapse -->
			</nav>
				<div class="modal fade" id="loginModal" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">

								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#login">Login</a></li>
									<li><a data-toggle="tab" href="#signup">SignUp</a></li>

								</ul>

								<div class="tab-content">
									<div id="login" class="tab-pane fade in active">
									</br>
									<?php
									$attributes = array("class" => "form-horizontal", "id" => "loginForm", "name" => "loginForm","role"=>"form");
									echo form_open("Login/success", $attributes);?>
									<div class="form-group">
										<label class="control-label col-sm-2" for="username">Username:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="usernameLogin" name="usernameLogin" placeholder="Enter Username or Email">
											<div class="alert alert-danger" role="alert" id="userNameLoginError" hidden="true"> </div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="pwd">Password:</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" id="passwordLogin" name="passwordLogin" placeholder="Enter password">
											<div class="alert alert-danger" role="alert" id="passwordLoginError" hidden="true">
											</div>
										</div>
									</div>
							<!-- Remember Me check box for cookies
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-10">
								 <div class="checkbox">
									<label><input type="checkbox"> Remember me</label>
								 </div>
							  </div>
							</div>
						-->
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button id="loginFormSubmit" type="button" class="btn btn-success">Login</button>
								<a  class="btn btn-success" type="button" href="#">Forgot Password</a>
							</div>
						</div>
						<?php echo form_close(); ?>

					</div>
					<div id="signup" class="tab-pane fade">

					</br>
					<?php
					$attributes = array("class" => "form-horizontal", "id" => "signupForm", "name" => "signupForm","role"=>"form");
					echo form_open("Signup/success", $attributes);?>
					<div class="form-group">
						<label class="control-label col-sm-2" for="emailID">Email ID:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="emailSignup" name="emailSignup"  placeholder="Enter Email">
							<div class="alert alert-danger" role="alert" id="emailSignupError" hidden="true">

							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="username">Username:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="usernameSignup" name="usernameSignup"  placeholder="Enter Username">
							<div class="alert alert-danger" role="alert" id="usernameSignupError" hidden="true">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="pwd">Password:</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="passwordSignup" name="passwordSignup" placeholder="Enter password">
							<div class="alert alert-danger" role="alert" id="passwordSignupError" hidden="true">

							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="confirmpwd">Confirm Password:</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="repasswordSignup" name="repasswordSignup" placeholder="Confirm password">
							<div class="alert alert-danger" role="alert" id="repasswordSignupError" hidden="true">

							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button id="signupFormSubmit" type="button" class="btn btn-success">Signup</button>
						</div>
					</div>
					<?php echo form_close(); ?>


				</div>

			</div>



		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
</div>
</div>
</div>
<br>
<br>
<br>

