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
// DONE:10 Add Options for filtering results.
// TODO:0 Add advanced filtering.
// TODO:10 Add System for parent/child PIDs
  public function getInv($request) {
    //$result = $this->query("SELECT * FROM `inventory` WHERE `inStock` = 1");
    $filter = $request["filter"];
    $list = explode(" ",$filter);
    $tags = count($list);
    $input = "SELECT * FROM `inventory` WHERE `inventory`.`onSale` = \"1\"";
    if($filter !== "none") {
      $filter = str_replace(' ','\', \'', $filter);
      $filter = "'".$filter."'";
      $input = "SELECT `inventory`.*\n"
      . "FROM `inventory`\n"
      . "LEFT JOIN `tagdir` ON `inventory`.`itemCode` = `tagdir`.`pid` \n"
      . "LEFT JOIN `tags` ON `tagdir`.`tid` = `tags`.`tid` \n"
      . "WHERE `tags`.`name` IN (".$filter.") \n"
      . "GROUP BY `inventory`.`itemCode` \n"
      . "HAVING COUNT(DISTINCT `tags`.`tid`) = $tags";
    }

    //$result = $this->query("SELECT * FROM `tags` WHERE `value` = \"juice\"");
    $result = $this->query($input);
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
  public function getInvW($request) {
    $input = "SELECT * FROM inventory WHERE `data` = \"-1\"";
    $test = $this->query($input);
    $rows = array();
    $subrows = array();
    if ($test->num_rows > 0) {
      while($row=$test->fetch_assoc()) {
        $rows[] = $row;
      }
    }
    $inputb = "SELECT * FROM inventory WHERE `data` != \"-1\"";
    $testb = $this->query($inputb);
    if($testb->num_rows > 0) {
      while($row=$testb->fetch_assoc()) {
        $subrows[] = $row;
      }
    }
    for($x=0;$x < count($subrows);$x++) {
      for($y=0;$y < count($rows); $y++) {
        if($subrows[$x]['data'] == $rows[$y]['itemCode']) {
          $rows[$y]['children'][] = $subrows[$x];
        }
      }
    }
    return json_encode($rows);
  }
//TODO:60 Implement separate userInfo tables.
//TODO:70 Unify internal UID lookup function.
  public function getUserInfo($request) {
    $token = $request["token"];
    $test = $this->query("SELECT `uid` FROM `tokens` WHERE `token` = \"".$token."\"");
    if($test->num_rows > 0){
      while($row=$test->fetch_row()) {
        $uid = $row[0];
      }
      $testb = $this->query("SELECT `uid`, `username` FROM `users` WHERE `uid` = \"".$uid."\"");
      while($row = $testb->fetch_assoc()) {
        return json_encode($row);
      }
    }
  }

  public function getPidByName($name) {
    $r = $this->query("SELECT `itemCode` FROM `inventory` WHERE `name` = \"{$name}\"");
    if($r->num_rows > 0){
      while($row=$r->fetch_assoc()){
        $pid = $row["itemCode"];
      }
      return $pid;
    }

  }

  public function getTagList() {
    $result = $this->query("SELECT * FROM tags WHERE vis = \"1\" GROUP BY(name) ORDER BY(heading)");
    $rows = array();
    while($row = $result->fetch_assoc()) {
      $rows[]= $row;
    }
    return json_encode($rows);
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
  public function verToken($token){
    $test = $this->query("SELECT `uid`, `token` FROM `tokens` WHERE `token` = \"".$token."\"");
    if($test->num_rows > 0){
      while($row = $test->fetch_assoc()) {
        return $row['uid'];
      }
    } else {
      return "false";
    }
  }
  public function verAdmin($uid){
    $testb = $this->query("SELECT `uid` FROM `admins` WHERE `uid` = \"".$uid."\"");
    if($testb->num_rows > 0) return 1;
    return 0;
  }

// Creates user in database.
  public function createUser($user, $hash, $email) {
    $query[0] = "INSERT INTO users (username, hash) VALUES ('".$user."', '".$hash."');";
    $query[1] = "INSERT INTO emails (uid, email) VALUES (LAST_INSERT_ID(), '".$email."');";
    $this->transaction($query);
  }
  public function addInv($request) {
    $name = $request["name"];
    $description = $request["description"];
    $avail = $request["avail"];
    $sale = $request["sale"];
    $stock = $request["stock"];
    $price = $request["price"];
    $tags = $request["tags"];
    $data = $request["data"];
    $input = "INSERT INTO inventory (name, description, onSale, inStock, avail, price, data) VALUES ('{$name}', '{$description}', '{$sale}', '{$stock}', '{$avail}', '{$price}', '{$data}')";
    //$input = "INSERT INTO inventory (name, inStock, description, onSale) VALUES ('".$request["name"]."', '".$request["stock"]."', '".$request["description"]."', '".$request["sale"]."')";
    $this->query($input);
    $pid = $this->getPidByName($name);
    $this->tagItem($tags, $pid);
  }

  // Maintains Clean Tag System
  public function tagItem($tags, $pid) {
    $taglist = explode(", ", $tags);
    $input = "INSERT IGNORE INTO `tags` (`tid`, `name`) VALUES (NULL, '{$taglist[0]}')";
    $update[0] = "INSERT INTO tagdir(tid, pid) SELECT tid, \"{$pid}\" FROM tags WHERE name = \"{$taglist[0]}\"";
    for($x=1; $x < count($taglist); $x++){
      $input .= ", (NULL, '{$taglist[$x]}')";
      $update[$x] = "INSERT INTO tagdir(tid, pid) SELECT tid, \"{$pid}\" FROM tags WHERE name = \"{$taglist[$x]}\"";
    }
    $this->query($input);
    $this->transaction($update);
  }


}

?>
