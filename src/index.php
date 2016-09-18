<!DOCTYPE html>
<!--
      Stratus
      Created by Cole Cassidy
      github.com/thecolec/stratus
      theColeC@gmail.com
-->

<html lang="en">
<?php require_once('login.php');?>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/stratusStore.css" >
<!-- Optional theme -->
<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"-->

<!-- Essential Meta Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="UTF-8">
<title>Stratus Storefront</title>

</head>

<body onload="initStratus()">
  <!-- Main Container NEVER REMOVE THIS -->
  <div class="container">

      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#stratusNav" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Stratus</a>
        </div>
        <div class="container-fluid">
        <div class="collapse navbar-collapse" id="stratusNav">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navShop">Shop</a>
            <ul class="dropdown-menu" id="shopMenu">
              <li><a onclick="" href="#">Juices</a></li>
              <li><a onclick="" href="#">Hardware</a></li>
            </ul>
          </li>
        </ul>
          <ul class="nav navbar-nav navbar-right">
            <!-- TODO: Add Login button for when modal is closed OR make modal forced -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navUsername"></a>
                <ul class="dropdown-menu" id="userMenu">
                  <!-- <li><a href="#">Options</a></li>
                  <li><a href="#">Help</a></li>
                  <li role="separator" class="divider"></li> -->
                  <li><a onclick="logout();" href="#">logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- This holds any dynamic content in a grid -->
    <div class="row" id="contentgrid">
    </div>
    <!-- Add button, only visable to admins, communicates via secured API-->

    <!-- Groundwork for an options framework.-->
    <!-- TODO: Implement an options menu -->
    <?php require_once('options.php'); ?>
  </div>
  <div class="container-fluid pull-right id="overlay">

  <button class="btn btn-primary" type="input" id="addInvBtn"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>
  </div>
  <!-- Essential JS from local -->
  <script>

  </script>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/stratus.js"></script>


  <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>
