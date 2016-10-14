<!DOCTYPE html>
<!--
      Stratus
      Created by Cole Cassidy
      github.com/thecolec/stratus
      theColeC@gmail.com
      Version: 0.4.1-105
-->
<!--__/\\\\\\\\\\\\_____/\\\________/\\\_____/\\\\\\\\\____________-->
<!--__\/\\\////////\\\__\/\\\_______\/\\\___/\\\///////\\\_________-->
<!--___\/\\\______\//\\\_\//\\\______/\\\___\/\\\_____\/\\\________-->
<!--____\/\\\_______\/\\\__\//\\\____/\\\____\///\\\\\\\\\/________-->
<!--_____\/\\\_______\/\\\___\//\\\__/\\\______/\\\///////\\\______-->
<!--______\/\\\_______\/\\\____\//\\\/\\\______/\\\______\//\\\____-->
<!--_______\/\\\_______/\\\______\//\\\\\______\//\\\______/\\\____-->
<!--________\/\\\\\\\\\\\\/________\//\\\________\///\\\\\\\\\/____-->
<!--_________\////////////___________\///___________\/////////_____-->
<html lang="en">
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/stratusStore.css" >
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<!-- Optional theme -->
<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"-->

<!-- Essential Meta Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="UTF-8">
<title>Stratus Storefront</title>

</head>

<body onload="initStratus()" style="font-family:Raleway;">
  <!-- Main Container NEVER REMOVE THIS -->
  <div class="container-fluid">
      <!-- Navbar area -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
          <!-- Collapsable Menu shown on mobile -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#stratusNav" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Brand Name TODO: Make more content Conf file dependent.-->
          <a class="navbar-brand" onclick="getInv(filterList);">Stratus</a>
        </div>
        <div class="container-fluid">
        <div class="collapse navbar-collapse" id="stratusNav">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navShop">Shop</a>
            <ul class="dropdown-menu" id="shopMenu">
              <li><a onclick="setFilter(this);" href="#" invTag="juice">Juices</a></li>
              <li><a onclick="setFilter(this);" href="#"invTag="hardware">Hardware</a></li>
            </ul>
          </li>
        </ul>
          <ul class="nav navbar-nav navbar-right">
            <!-- TODO: Add Login button for when modal is closed OR make modal forced -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navUsername"></a>
                <ul class="dropdown-menu" id="userMenu">
                  <li><a href="#" data-toggle="modal" data-target="#aboutStratusModal">About</a></li>
                  <li><a href="#" data-toggle="modal" data-target="#reportBugModal">Report a Bug</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a onclick="logout();" href="#">logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- This holds any dynamic content in a grid -->
    <div class="row" id="">
      <div class="col-xs-10 col-xs-offset-1">
        <div class="row" id="contentgrid">

        </div>
      </div>
    </div>
    <!-- Add button, only visable to admins, communicates via secured API-->

    <!-- Groundwork for an options framework.-->
    <!-- TODO: Complete options menu. -->
    <?php require_once('login.php');?>
    <?php require_once('addinv.php'); ?>
    <?php require_once('itemCard.php') ?>
  </div>
  <div class="container-fluid" id="overlay">
    <div class="panel panel-default pull-left">
      <div class="panel-body">
        <button class="btn btn-success btn-lg" type="button" id="addFilterBtn" onclick="getTags();"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>
        <button class="btn btn-danger btn-lg hidden " type="button" id="clearFilterBtn"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>
      </div>
    </div>
    <div class="panel panel-default pull-right hidden" id="adminOverlay">
      <div class="panel-body">
        <button class="btn btn-danger btn-lg" type="button" onclick="gridRenderInvAdd('invAddChild.php');" id="addInvBtn"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></button>
        <a class="btn btn-primary btn-lg" type="button" id="searchInv" onclick="gridRenderOptions();"><span class="glyphicon glyphicon-cog" aria-hidden="true" ></span></a>
      </div>
    </div>

  </div>
  <!-- Essential JS from local -->
  <script>

  </script>
  <script src="js/jquery.js"></script>              <!--jQuery import               -->
  <script src="js/bootstrap.js"></script>           <!--Bootstrap import            -->
  <script src="js/stratus.js"></script>             <!--Stratus core import         -->
  <script src="js/stratusGrid.js"></script>         <!--Stratus grid system         -->
  <script src="js/stratusValidate.js"></script>     <!--Stratus form validation     -->
  <script src="js/stratusAuth.js"></script>         <!--Stratus user authentication -->
  <script src="js/stratusAdminInv.js"></script>     <!--Stratus Admin Functions     -->
  <script src="js/Vibrant.js"></script>             <!--Vibrant image swatch thingy -->


  <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>
