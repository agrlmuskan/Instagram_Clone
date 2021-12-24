<div class="notifications_div">

  <div class="notifications_header">
    <span class="noti_count">
      <?php
        $count = $noti->notiCount();
        if($count == 0){
          echo "No notifications";
        } else if($count == 1){
          echo "1 notification";
        } else {
          echo "$count notifications";
        }
      ?>
    </span>
      <span class="clear_noti" data-description='Clear notifications'>
        <?php if($noti->notiCount() != 0){ ?>
        <i class="material-icons">clear_all</i>
        <?php } ?>
      </span>
  </div>

  <?php $noti->getNotifications("direct", "0"); ?>

</div>
