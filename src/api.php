<?php

$servername = "localhost";
$username = "localStratus";
$password = "";
$dbname = "Stratus";
$sql = "SELECT * FROM `inventory` WHERE `inStock` = 1";


//beta test api stuff
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/',"/".$_GET['request']);
$key = array_shift($request)+0;
//echo $request[0];
$param1 = $request[0];
//$param2 = $request[1];

if ($request[0] == "inv"){
  if ($request[1] == "listall") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "id: " . $row["itemCode"]. " - Name: " . $row["name"]. " " . $row["description"]. "<br>";
      }
    } else {
        echo "0 results";
    }
    $conn->close();
  }
  if ($request[1] == "count") {

  }
}
?>
