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

  public function transaction($query) {
        $database = $this -> connect();
        $database->begin_transaction();
        foreach ($query as $x) {
          $database->query($x);
        }
        $database->commit();

  }

  public function getInv($options) {
    $result = $this->query("SELECT * FROM `inventory` WHERE `inStock` = 1");
    if ($result->num_rows > 0) {
      // output data of each row

      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
        //echo "id: " . $row["itemCode"]. " - Name: " . $row["name"]. " - Description: " . $row["description"]. "<br>";
      }
      return $rows;
    } else {
        echo "0 results";
    }
  }

// Gets required verification code.
  public function checkCode($code) {
    $test = $this->query("SELECT `Name`, `Value` FROM `config` WHERE `Name` = \"secretCode\"");
    while ($row = $test->fetch_row()) {
      if ($row[1] == $code) {
        return true;
      } else {
        return false;
      }
    }
    return "Error: Code not found.";
  }

// Creates user in database.
  public function createUser($user, $hash, $email) {
    $query[0] = "INSERT INTO users (username, hash) VALUES ('".$user."', '".$hash."');";
    $query[1] = "INSERT INTO emails (uid, email) VALUES (LAST_INSERT_ID(), '".$email."');";
    $this->transaction($query);
  }


}

?>
