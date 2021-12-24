<?php
  session_start();
  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") {

    include_once '../../config/class/needy_class.php';
    include '../../config/class/bkmrk.class.php';
    $bookmark = new bookmark;

    if (isset($_GET['bkmrk'])) {
      $post = preg_replace("#[^0-9]#i", "", $_GET['bkmrk']);
      $bookmark->bkmrk($post);
    }

    if (isset($_GET['unbkmrk'])) {
      $post = preg_replace("#[^0-9]#i", "", $_GET['unbkmrk']);
      $bookmark->unbkmrk($post);
    }

  }
?>
