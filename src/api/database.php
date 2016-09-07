<?php
class dbHost {

//essential mysql settings


  protected static $database;

  public function connect() {
    $servername = "localhost";
    $username = "localStratus";
    $password = "";
    $dbname = "Stratus";
    $this->database = new mysqli($servername, $username, $password, $dbname);
    if ($this->database->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $this->database;
  }

  public function query($query) {
        // Connect to the database
        $database = $this -> connect();

        // Query the database
        $result = $database-> query($query);

        return $result;
  }

  public function getInv($options) {
    $result = $this->query("SELECT * FROM `inventory` WHERE `inStock` = 1");
    if ($result->num_rows > 0) {
      // output data of each row

      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
        //echo "id: " . $row["itemCode"]. " - Name: " . $row["name"]. " - Description: " . $row["description"]. "<br>";
      }
      if($options == "php") {
        return $rows;
      } else {
        return json_encode($rows);
      }
    } else {
        echo "0 results";
    }
  }

}

?>
