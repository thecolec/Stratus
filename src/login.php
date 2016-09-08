<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Optional theme -->
    <!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"-->

    <!-- Essential Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="UTF-8">
    <title>Stratus Login</title>
  </head>
  <body onload="renderStratus();">
    <div class="container">
<!-- Login Modal -->
      <div class="modal fade in" tabindex="-1" role="dialog" id="login">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body clearfix">
              <h1 class="text-center"></h1>
              <!-- Login Form -->
              <form id="login" name="login" class="form-horizontal" action="api/auth" onsubmit="return validateForm()" method="post">
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
    </div>
    <!-- Essential JS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/stratus.js"></script>
    <!-- Reload Script -->
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
  </body>
</html>
