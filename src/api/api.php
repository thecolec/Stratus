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
      return $db -> getInv($this->mode);
    } else {
      return "Error: Invalid Request";
    }
  }

// Initiates Authorization.
  protected function auth() {
    if ($this->method == 'POST') {
    } else {
      return "Error: Invalid Request";
    }
  }

// Initiates User Enrollment
  protected function enroll() {
    if ($this->method == 'POST') {
      $builder = new userBuilder($this->request);
      $builder->addUser();
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
