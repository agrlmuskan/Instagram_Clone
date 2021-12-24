<?php include '../../config/declare.php'; ?>

<!-- a universal file that has all the classes included -->
<?php include '../../config/classesGetter.php'; ?>

<!-- creating objects -->
<?php
  $explore = new explore;
?>

<div class="exp_find_photos">

  <?php echo $explore->explorePhotos(); ?>

</div>

<script type="text/javascript">
  $(function(){

    $('.exp_f_ph_img > img').imageShow({info: "yes"});

  });
</script>
