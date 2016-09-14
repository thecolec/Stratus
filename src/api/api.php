<?php
require_once 'apiInterpreter.php';
require_once 'database.php';
require_once 'userprocessor.php';
class MyAPI extends API {

//from here down are endpoint definitions
//$endpoint/$verb/$args/$args

// Inventory endpoint.
  protected function inv() {
    if ($this->method == 'GET') {
      $db = new dbHost();
      return $db -> getInv();
    } else {
      return "Error: Invalid Request";
    }
  }

// Authorization Endpoint
  protected function auth($args) {
    $db = new dbHost();
    // POST
    if ($this->method == 'POST') {

      // Create Secret Code Mode
      if ($this->mode == "secretcode") {
        header("Content-Type: application/json");
        return json_encode($db->checkCode($this->request["secretcode"]));
      // User Authorization Mode
      } else if($this->mode == "auth") {
        $auth = new userAuth($this->request);
        $token = $auth->authorizeUser();
        // If user has a token
        if ($token != false){
          setcookie('token', $token, time()+(86400*30), "/");
          header("Content-Type: text/html; charset=utf-8");
          return "<script type=\"text/javascript\">window.location.href = '/ '</script>";
        }
      // Token Verification Mode
      } else if($this->mode == "tokenVer") {
          return $db->verToken($this->request);
      }
    } else {
      return "Error: Invalid Request";
    }
  }
// TODO:0 Add input parser to prevent injection attacks.
// TODO:10 Improve token system to lock token to a specific session.
// Information Endpoint
  protected function info() {
    $db = new dbHost();
    // GET
    if($this->method == 'GET') {
      if($this->mode == "username"){
        return $db->getUserInfo("uid",$this->request["uid"]);
      }
    }
  }

// Enrollment Endpoint
  protected function enroll() {
    if ($this->method == 'POST') {
      header("Content-Type: text/html; charset=utf-8");
      $builder = new userBuilder($this->request);
      return $builder->addUser();
    } else {
      return "Error: Invalid Request";
    }
  }

// apiwall is a catch for any request sent to an incorrect location.
  protected function apiwall() {
    if ($this->method == 'GET') {
      return "No endpoint specified.";
    }
  }
}

// fixes weird local request. Don't change it.
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>
