<?php
  class mention_class{

    protected $db;
    protected $DIR;

    public function __construct(){
      $db = N::_DB();
      $DIR = N::$DIR;

      $this->db = $db;
      $this->DIR = $DIR;
    }

    public function mention($str){
      $str = trim($str);
      $regex = "/@+([^ <>]+)/";
      $str = preg_replace($regex, "<a class="."hashtag"." href="."{$this->DIR}/profile/$1".">$0</a>", $str);
      return $str;
    }

    public function getMentions($text, $post){
      $session = $_SESSION['id'];
      $universal = new universal;
      $noti = new notifications;
      $array = explode(" ", trim($text));
      $array = preg_split('/\r\n|\r|\n/', $text);

      foreach ($array as $key) {
        $key = trim($key);
        if ($key[0] == "@" && $key[0] != "#") {
          $user = substr($key, 1);
          $query = $this->db->prepare("SELECT username FROM users WHERE username = :username");
          $query->execute(array(":username" => $user));

          if ($query->rowCount() == 1) {
            $to = $universal->getIdFromGet($user);
              $noti->actionNotify($to, $post, "post_mention");
          }
        }
      }

    }

  }
?>
