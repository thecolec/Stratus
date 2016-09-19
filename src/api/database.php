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
  public function getInv() {
    $result = $this->query("SELECT * FROM `inventory` WHERE `inStock` = 1");
    if ($result->num_rows > 0) {
      // output data of each row
      $i = 0;
      while($row = $result->fetch_assoc()) {
        $rows["item"][$i++] = $row;
        //echo "id: " . $row["itemCode"]. " - Name: " . $row["name"]. " - Description: " . $row["description"]. "<br>";
      }
      return json_encode($rows);
    } else {
        echo "0 results";
    }
  }

//TODO: Implement separate userInfo tables.
//TODO: Unify internal UID lookup function.
  public function getUserInfo($request) {
    $token = $request["token"];
    $test = $this->query("SELECT `uid` FROM `tokens` WHERE `token` = \"".$token."\"");
    if($test->num_rows > 0){
      while($row=$test->fetch_row()) {
        $uid = $row[0];
      }
      $testb = $this->query("SELECT * FROM `users` WHERE `uid` = \"".$uid."\"");
      while($row = $testb->fetch_assoc()) {
        return json_encode($row);
      }
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
      return "false";
    }
  }
  public function verAdmin($request){
    $token = $request['token'];
    $test = $this->query("SELECT `uid` FROM `tokens` WHERE `token` = \"".$token."\"");
    if($test->num_rows > 0){
      while($row=$test->fetch_row()) {
        $uid = $row[0];
      }
      $testb = $this->query("SELECT `uid` FROM `admins` WHERE `uid` = \"".$uid."\"");
      if($testb->num_rows > 0) return "true";
      return "false";
    } else {
      return "false";
    }
  }

// Creates user in database.
  public function createUser($user, $hash, $email) {
    $query[0] = "INSERT INTO users (username, hash) VALUES ('".$user."', '".$hash."');";
    $query[1] = "INSERT INTO emails (uid, email) VALUES (LAST_INSERT_ID(), '".$email."');";
    $this->transaction($query);
  }
  public function addInv($request) {
    $input = "INSERT INTO inventory (name, inStock, description, onSale) VALUES ('".$request["name"]."', '".$request["stock"]."', '".$request["description"]."', '".$request["sale"]."')";
    if($this->verAdmin($request)) {
      $this->query($input);
    } else {
      return "ERROR: Not Authorized";
    }
  }


}

?>
