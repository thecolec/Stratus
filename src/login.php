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
      <div class="modal fade in" tabindex="-1" role="dialog" id="login">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body clearfix">
              <h1 class="text-center">Stratus</h1>
              <form>
                <div class="form-group">
                  <label for="username">User:</label>
                  <input type="text" class="form-control" id="username" placeholder="User" />
                </div>
                <div class="form-group">
                  <label for="pass">Password:</label>
                  <input type="password" class="form-control" id="pass" placeholder="Password" />
                </div>
                <button type="submit" class="btn btn-default pull-right">Login</button>
              </form>
              <button class="btn btn-default" onclick="toggleRegister();">Register</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade in" tabindex="-1" role="dialog" id="register">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body clearfix">
              <h1 class="text-center">Stratus</h1>
              <form>
                <div class="form-group">
                  <label for="username">User:</label>
                  <input type="text" class="form-control" id="username" placeholder="User" />
                </div>
                <div class="form-group">
                  <label for="key">Secret Code:</label>
                  <input type="password" class="form-control" id="key" placeholder="Secret Code" />
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="example@email.com" />
                </div>
                <div class="form-group">
                  <label for="pass">Password:</label>
                  <input type="password" class="form-control" id="pass" placeholder="Password" />
                </div>
                <div class="form-group">
                  <label for="pass2">Repeat Password:</label>
                  <input type="password" class="form-control" id="pass2" placeholder="Password" />
                </div>
                <button type="submit" class="btn btn-default pull-right">Register</button>
              </form>
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
