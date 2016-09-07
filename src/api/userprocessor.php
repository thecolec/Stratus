<?php
abstract class user {
  protected $username   = '';
  protected $token      = '';
  protected $id         = '';

  public function __construct() {

  }
}

class userBuilder {
  private $username   = '';
  private $secretcode = '';
  private $email      = '';
  private $pass       = '';
  private $hash       = '';

  public function __construct($request) {
    $this->username = $request["username"];
    $this->secretcode = $request["secretcode"];
    $this->email = $request["email"];
    $this->pass = $request["pass"];

    $this->hash = password_hash($this->pass, PASSWORD_DEFAULT);
  }

//Verifies secretcode
  public function verCode(){

    $db = new dbHost();
    $check = $db->checkCode();
    print_r($check);
    if ($check ==  $this->secretcode){
      return TRUE;
    } else {
      return FALSE;

    }
  }

  public function addUser(){
    if($this->verCode()){
      print_r("adding user");
      $db = new dbHost();
      $db->createUser($this->username, $this->hash, $this->email);
    } else {
      return "Invalid Code";
    }
  }


}
?>
