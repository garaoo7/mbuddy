
<div id="signupModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">SIGNUP</h4>
         </div>
         <div class="modal-body">
            <form role="form" id="signupForm" name="signupForm">  
               <div class="form-group">
                  <label>Email Address:
                     <input type="text" class="form-control" name="emailAddress" placeholder="email@example.com" value="asd@asd.com">
                  </label>
                  <div class="row">
                     <div class="col-md-6">
                        <div id="emailError" hidden></div>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label>Username:
                     <input type="text" class="form-control" name="username" placeholder="Username" value="sss">
                  </label>
                  <div class="row">
                     <div class="col-md-6">
                        <div id="usernameError" hidden></div>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label>Password:
                     <input type="password" class="form-control" name="password" placeholder="Password" value="sss">
                  </label>
                  <div class="row">
                     <div class="col-md-6">
                        <div id="passwordError" hidden></div>
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <label>Retype Password:
                     <input type="password" class="form-control" name="repassword" placeholder="Re-password" value="sss">
                  </label>
                  <div class="row">
                     <div class="col-md-6">
                        <div id="repasswordError" hidden></div>
                     </div>
                  </div>
               </div>

               <button id=signupFormSubmit class="btn btn-default" name="submit" type="button">Signup</button>
            </form>
         </div>
         <div class="modal-footer">
           <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
     </div>
  </div>
</div>

