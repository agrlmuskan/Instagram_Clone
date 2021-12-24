<?php include 'config/declare.php'; ?>

<!-- a universal file that has all the classes included -->
<?php include 'config/classesGetter.php'; ?>

<!-- creating objects -->
<?php
  $universal = new universal;
  $avatar = new Avatar;
  $post = new post;
  $noti = new notifications;
  $message = new message;
?>

<?php
  if ($universal->isLoggedIn() == false) {
    header('Location:'. DIR .'/login');
  }
  $session = $_SESSION['id'];
?>

<?php
  $title = "{$noti->titleNoti()} Messages • Instagram";
  $keywords = "Instagram, Share and capture world's moments, share, capture, messages";
  $desc = "Instagram lets you capture, follow, like and share world's moments in a better way and tell your story with photos, messages, posts and everything in between";
?>

<!-- including files for header of document -->
<?php include_once 'includes/header.php'; ?>
<?php include_once 'needs/heading.php'; ?>
<?php include_once 'needs/nav.php'; ?>

<div class="user_info" data-userid="<?php echo $session; ?>" data-sessionid="<?php echo $session; ?>" data-username="<?php echo $universal->getUsernameFromSession(); ?>"></div>

<div class="overlay"></div>
<div class="overlay-2"></div>
<div class="notify"><span></span></div>

<div class="badshah mssg_badshah">

  <div class="mssg_left">

    <div class="mssg_new">
      <a href="#" class="pri_btn new_con"><span>New conversation</span></a>
    </div>

    <div class="mssg_add_persons">
      <input type="text" name="" value="" placeholder="Search to message" spellcheck="false">
    </div>

    <span class='con_count' data-count='<?php echo $message->conCount(); ?>'><?php echo $message->conCount(); ?> conversations</span>
    <?php $message->conversations(); ?>

  </div>

  <div class="mssg_right">
    <div class='home_last_mssg mssg_last_mssg'>
      <img src='<?php echo DIR; ?>/images/needs/large.jpg'>
      <span>Please select a conversation</span>
    </div>
  </div>

</div>

<?php include 'needs/message_div.php'; ?>
<?php include 'needs/emojis.php'; ?>
<?php include_once 'needs/display.php'; ?>
<?php include_once 'needs/prompt.php'; ?>
<?php include 'needs/image_show.php'; ?>
<?php include 'needs/stickers.php'; ?>
<?php include_once 'needs/search.php'; ?>

<!-- including the footer of the document -->
<?php include_once 'includes/footer.php'; ?>

<script type="text/javascript">
  $(function(e){
    LinkIndicator("messages");
  });
</script>
