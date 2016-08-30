<?php

$servername = "localhost";
$username = "localStratus";
$password = "";
$dbname = "Stratus";
$sql = "SELECT * FROM `inventory` WHERE `inStock` = 1";

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
echo $_GET["name"];
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
echo $method;
echo $request;

?>
