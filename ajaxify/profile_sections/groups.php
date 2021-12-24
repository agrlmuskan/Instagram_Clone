<?php include '../../config/declare.php'; ?>

<!-- a universal file that has all the classes included -->
<?php include '../../config/classesGetter.php'; ?>

<!-- creating objects -->
<?php
  $universal = new universal;
  $tags = new tags;
  $avatar = new Avatar;
  $follow = new follow_system;
  $general = new general;
  $post = new post;
  $mutual = new mutual;
  $recommend = new recommend;
  $groups = new group;
?>

<?php
  $get_id = $universal->getIdFromGet($_GET['u']);
  if (isset($_SESSION['id'])) {
    $session_id = $_SESSION['id'];
  }
?>
