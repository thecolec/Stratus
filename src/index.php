<!DOCTYPE html>
<!--
      Stratus
      Created by Cole Cassidy
      github.com/thecolec/stratus
      theColeC@gmail.com
-->

<html lang="en">
<?php require_once('login.php'); ?>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
    <h1 class="text-center">Stratus Storefront</h1>
      <nav class="navbar navbar-default">
        <div class="container-fluid">

        <ul class="nav navbar-nav">
          <li class="active" id="main"><a href="#">Main</a></li>
          <li class="" id="cart"><a href="#">Your Cart</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="hidden-xs navbar-brand dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navUsername"></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a onclick="logout();" href="#">logout</a></li>
            </ul>
          </li>
        </ul>

      </div>
      </nav>
    <div class="row" id="inventorygrid">
      <?php
        require_once('api/database.php');
        $db = new dbHost();
        $items = $db->getInv('php');
        foreach($items as $x){
          include('itemPanel.php');
        }
      ?>
    </div>
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
