<div class="container">
<!-- Login Modal
TODO: Add failure redirect.-->
  <div class="modal fade in" tabindex="-1" role="dialog" id="login">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body clearfix">
          <h1 class="text-center"></h1>
          <!-- Login Form -->
          <form id="login" name="login" class="form-horizontal" action="api/auth/auth" onsubmit="return validateForm()" method="post">
            <!-- Username -->
            <div id="loginUserDiv" class="form-group">
              <label class="col-sm-3 control-label" for="loginUser">User:</label>
              <div class="col-sm-8">
                <input type="text" name="username" class="form-control" id="loginUser" placeholder="User" onkeyup="validateUser(this);"/>
              </div>
            </div>
            <!-- Password -->
            <div id="loginPassDiv" class="form-group">
              <label class="col-sm-3 control-label" for="pass">Password:</label>
              <div class="col-sm-8 control-label">
                <input type="password" name="password" class="form-control" id="loginPass" placeholder="Password" onkeyup="validatePass(this);"/>
              </div>
            </div>
            <!-- Submit -->
            <button id="loginSubmit" type="submit" class="btn btn-primary pull-right">Login</button>
          </form>
          <!-- Switch to registration -->
          <button class="btn btn-default" onclick="toggleRegister();">Register</button>
        </div>
      </div>
    </div>
  </div>
<!-- Registration Modal -->
  <div class="modal fade in" tabindex="-1" role="dialog" id="register">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body clearfix">
          <h1 class="text-center"></h1>
          <!-- Registration Form -->
          <form id="register" name="enroll" class="form-horizontal" action="api/enroll" onsubmit="return validateForm()" method="post">
            <!-- Username -->
            <div id="registerUserDiv" class="form-group">
              <label class="col-sm-3 control-label" for="registerUser">User:</label>
              <div class="col-sm-8">
                <input type="text" name="username" class="form-control" id="registerUser" placeholder="User" onkeyup="validateUser(this);"/>
              </div>
            </div>
            <!-- Secret Code -->
            <div id="regCodeDiv"class="form-group">
              <label class="col-sm-3 control-label" for="regCode">Secret Code:</label>
              <div class="col-sm-8">
                <input type="password" name="secretcode" class="form-control" id="regCode" placeholder="Secret Code" onblur="validateCode(this);"/>
              </div>
            </div>
            <!-- Email -->
            <div class="form-group">
              <label class="col-sm-3 control-label" for="email">Email:</label>
              <div class="col-sm-8">
                <input type="email" name="email" class="form-control" id="email" placeholder="example@email.com" />
              </div>
            </div>
            <!-- Password -->
            <div id="regPassDiv" class="form-group">
              <label class="col-sm-3 control-label" for="regPass">Password:</label>
              <div class="col-sm-8">
                <input type="password" name="pass" class="form-control" id="regPass" placeholder="Password" onkeyup="validatePass(this);"/>
              </div>
            </div>
            <!-- Password Verification -->
            <div id="regPass2Div" class="form-group">
              <label class="col-sm-3 control-label" for="pass2">Verify:</label>
              <div class="col-sm-8">
                <input name="pass2" type="password" class="form-control" id="regPass2" placeholder="Verify Password" onkeyup="validatePass(this);"/>
              </div>
            </div>
            <!-- Submit -->
            <button id="registerSubmit" type="submit" class="btn btn-primary pull-right">Register</button>
          </form>
          <!-- Switch to login -->
          <button class="btn btn-default" onclick="toggleLogin();">Login</button>
        </div>
      </div>
    </div>
  </div>
  <!-- About Stratus Modal -->
    <div class="modal fade in" tabindex="-1" role="dialog" id="aboutStratusModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body clearfix text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h1>Stratus</h1>
            <h3>"The update of many tags!"</h3>
            <h5>Version: 0.4.1-195</h5>
            <h4>Created by Cole Cassidy</h4>
            <h4>@theColeC</h4>
          </div>
        </div>
      </div>
    </div>
    <!-- Bug Report Modal -->
      <div class="modal fade in" tabindex="-1" role="dialog" id="reportBugModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body clearfix text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4>Tell Daddy what happened:</h4>
            </div>
          </div>
        </div>
      </div>
</div>
