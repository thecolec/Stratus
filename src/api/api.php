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
    if ($this->method == 'POST') {
      // Code Authorization Mode
      if ($this->mode == "secretcode") {
        header("Content-Type: application/json");
        return json_encode($db->checkCode($this->request["secretcode"]));
      } else if($this->mode == "auth") {
        $auth = new userAuth($this->request);
        $token = $auth->authorizeUser();
        if ($token != false){
          setcookie('token', $token, time()+(86400*30), "/");
          header("Content-Type: text/html; charset=utf-8");
          return "<script type=\"text/javascript\">window.location.href = '/ '</script>";
        }
      } else if($this->mode == "tokenVer") {
          return $db->verToken($this->request);
      }
    } else {
      return "Error: Invalid Request";
    }
  }

// Enrollment Engpoint
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
