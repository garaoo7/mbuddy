<div id="loginModal" class="modal fade" role="dialog">
  	<div class="modal-dialog">
  		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">LOGIN</h4>
      		</div>
      		<div class="modal-body">
				<form role="form" id="loginForm" name="loginForm">	

					<div class="form-group">
						<label>Username or Email:
	  						<input type="text" class="form-control" id="username" name="username" placeholder="Username or email">
	  					</label>
	  					<div class="row">
					  	<div class="col-md-6">
					  		<div id="usernameErrorL" hidden></div>
					  	</div>
				  	</div>
	  				</div>

			  		<div class="form-group">
				  		<label>Password:
				  			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				  		</label>
				  		<div class="row">
					  		<div class="col-md-6">
					  			<div id="passwordErrorL" hidden></div>
					  		</div>
				  		</div>
				  	</div>

				  	<div class="checkbox">
			   			<label><input type="checkbox">Remember me</label>
			 		</div>
				  	<button id="loginFormSubmit" class="btn btn-default" name="submit" type="button">Login</button>
				</form>
			</div>
			<div class="modal-footer">
        		<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      		</div>
    	</div>
  	</div>
</div>

