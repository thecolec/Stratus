<?php
class userAuth {
  protected $username   = '';
  protected $hash       = '';
  protected $token      = '';
  protected $id         = '';

  public function __construct($request) {
    $this->username = $request["username"];
    $this->password = $request["password"];
  }
  public function authorizeUser() {
    $db = new dbHost();
    $temp = $db->checkUser($this->username,$this->password);
    if(!$temp){
      return false;
    } else if($temp[1] == true) {
        return $this->buildToken($temp[0],$this->username);

    } else {
      return false;
    }
  }

  private function buildToken($uid, $username){
    $token = md5(uniqid($uid+$username+rand(),true));
    $db = new dbHost();
    $db->regToken($uid, $token);
    return $token;
  }
}

class userBuilder {
  private $username   = '';
  private $secretcode = '';
  private $email      = '';
  private $pass       = '';
  private $hash       = '';

//TODO:20 check for void info.
  public function __construct($request) {
      $this->username   = $request["username"];
      $this->secretcode = $request["secretcode"];
      $this->email      = $request["email"];
      $this->pass       = $request["pass"];
      $this->hash       = password_hash($this->pass, PASSWORD_DEFAULT);
  }

//Verifies secretcode
  public function verCode(){

    $db = new dbHost();
    return $db->checkCode($this->secretcode);
  }

//Formats user info and writes to database.
  public function addUser(){
    if($this->verCode()){
      $db = new dbHost();
      $db->createUser($this->username, $this->hash, $this->email);
      return "<script type=\"text/javascript\">window.location.href = '/ '</script>";
    } else {
      return "Invalid Code";
    }
  }


}
?>
