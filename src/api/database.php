<?php
class dbHost {

//essential mysql settings


  protected static $database;

// Operational Functions.

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

// Stratus specific functions.

// Gets Inventory information
// TODO.Add Options for filtering results.
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

//TODO: Implement separate userInfo table.
  public function getUserInfo($field,$value) {
    $result = $this->query("SELECT * FROM `users` WHERE `".$field."` = \"".$value."\"");
    while($row = $result->fetch_assoc()) {
      return json_encode($row);
    }
  }

// Authorization Related Functions

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

// Pulls user information from db
  public function checkUser($username, $password) {
    $test = $this->query("SELECT `uid`, `hash` FROM `users` WHERE `username` = \"".$username."\"");
    while($row = $test->fetch_row()) {
      if(password_verify($password, $row[1])) {
        $temp = array($row[0], true);
        return $temp;
      } else {
        return false;
      }
    }
    return "Error: Verification System Failed.";

  }
  public function regToken($uid, $token){
    $this -> query("INSERT INTO tokens (uid, token) VALUES ('".$uid."', '".$token."') ON DUPLICATE KEY UPDATE token = values(token)");
  }
  public function verToken($request){
    $token = $request['token'];
    $test = $this->query("SELECT `uid`, `token` FROM `tokens` WHERE `token` = \"".$token."\"");
    if($test->num_rows > 0){
      while($row = $test->fetch_row()) {
        return $row[0];
      }
    } else {
      return false;
    }
  }

// Creates user in database.
  public function createUser($user, $hash, $email) {
    $query[0] = "INSERT INTO users (username, hash) VALUES ('".$user."', '".$hash."');";
    $query[1] = "INSERT INTO emails (uid, email) VALUES (LAST_INSERT_ID(), '".$email."');";
    $this->transaction($query);
  }


}

?>
