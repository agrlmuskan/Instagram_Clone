<?php
  class login_class{

    protected $db;
    protected $DIR;
    protected $gmail;
    protected $gmail_password;

    public function __construct(){
      $db = N::_DB();
      $DIR = N::$DIR;
      $GMAIL = N::$GMAIL;
      $GMAIL_PASS = N::$GMAIL_PASSWORD;

      $this->db = $db;
      $this->DIR = $DIR;
      $this->gmail = $GMAIL;
      $this->gmail_password = $GMAIL_PASS;
    }

    public function LOGIN($username, $password, $ip){
      if (($username || $password) == "") {
        return "Your values are missing";
      } else {
        $query = $this->db->prepare("SELECT password FROM users WHERE username = :username LIMIT 1");
        $query->execute(array(":username" => $username));
        if ($query->rowCount() == 0) {
          return "Incorrect details";
        } else {
          $row = $query->fetch(PDO::FETCH_OBJ);
          $pass = $row->password;
          if (password_verify($password, $pass)) {
            $iquery = $this->db->prepare("SELECT id FROM users WHERE username = :username AND password = :password LIMIT 1");
            $iquery->execute(array(":username" => $username, ":password" => $pass));
            $irow = $iquery->fetch(PDO::FETCH_OBJ);
            $id = $irow->id;
            $random = new random;
            $os = $random->getOS();
            $browser = $random->getBrowser();
            $lquery = $this->db->prepare("INSERT INTO login(user_id, ip, time, os, browser) VALUES(:id, :ip, now(), :os, :browser)");
            $lquery->execute(array(":id" => $id, ":ip" => $ip, ":os" => $os, ":browser" => $browser));
            $_SESSION['id'] = $id;
            return "Successfull";
          } else {
            return "Incorrect password";
          }
        }
      }
    }

    public function LOGOUT(){
      $id = $_SESSION['id'];

      $query = $this->db->prepare("SELECT MAX(login_id) AS myGet FROM login WHERE user_id = :id LIMIT 1");
      $query->execute(array(":id" => $id));
      $row = $query->fetch(PDO::FETCH_OBJ);
      $login_id = $row->myGet;

      $mquery = $this->db->prepare("UPDATE login SET logout = now() WHERE login_id = :id");
      $mquery->execute(array(":id" => $login_id));
      session_destroy();
      header("Location: login");
    }
    
    public function usernameChecker($value){
      $query = $this->db->prepare("SELECT id FROM users WHERE username = :username");
      $query->execute(array(":username" => $value));
      $count = $query->rowCount();
      if ($count == 0) {
        echo "<span class='checker_text'>username is available</span><span class='checker_icon'>
          <i class='fa fa-smile-o' aria-hidden='true'></i></span>";
      } else if ($count > 0) {
        echo "<span class='checker_text'>username already taken</span><span class='checker_icon'>
          <i class='fa fa-frown-o' aria-hidden='true'></i></span>";
      }
    }

  }
?>
