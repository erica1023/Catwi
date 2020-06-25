<?php

//catwiを参照
if (!empty($only_my_catwis)) {
  $where = " WHERE users_id = {$_SESSION['users_id']} ";
} else {
  $where = '';
}
$sql = "SELECT catwis.*,icon FROM catwis LEFT JOIN users ON users.id=users_id {$where} ORDER BY id DESC LIMIT 51";
$result = $dbh->query($sql);
$catwi_data = $result->fetchAll();

?>
<?php foreach ($catwi_data as $row): ?>


  <!--Catwi表示例-->
  <div id="catwi" class="clearfix" catwis_id="<?=$row['id']?>">
    <div id="icon_margin">
  <img class="icon" src="<?=$row['icon']?>" alt="アイコン" users_id="<?=$row['users_id']?>"><!--アイコン-->
    </div>
    <?php if($row['img']): ?>
      <img class="catwi_img" src=<?=$row['img'] ?> alt="猫写真"><!--Catwi写真-->
    <?php endif; ?>
      <div class="catwi_text">
      <p><br><?=$row['catwi_text']?></p><!--Catwiテキスト-->
      </div>
    </div><!--catwi-->


  <?php endforeach; ?>

  <script>
  $('div#catwi').click(function (event) {
  if ($(event.target).hasClass('icon')) {
    url = 'mycat_another.php?users_id=' + $(event.target).attr('users_id');
  } else {
    url = 'catwi_about.php?catwis_id=' + $(this).attr('catwis_id');
  }
  $('body').addClass('fadeout');
  setTimeout(function(){
    location.href = url;
  }, 500);
});

  </script>
