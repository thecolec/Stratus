<?php
require_once 'apiInterpreter.php';
require_once 'database.php';
class MyAPI extends API {

//from here down are endpoint definitions
//$endpoint/$verb/$args/$args
  protected function inv() {
    if ($this->method == 'GET') {
      $db = new dbHost();
      return $db -> getInv($this->mode);
    } else {
      return "Error: Invalid Request";
    }
  }
  protected function apiwall() {
    if ($this->method == 'GET') {
      return "<html>API server Online. <br/> Check docs for help.</html>";
    } else {
      return "Nope!!";
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
