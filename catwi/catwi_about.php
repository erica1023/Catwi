<?php
require_once('top.php');

//catwiを参照
$sql = "SELECT * FROM catwis WHERE id = {$_GET['catwis_id']}";
$result = $dbh->query($sql);
$catwi_data = $result->fetchAll();


//commentを登録
if(isset($_POST['comment'])) {
$sql = "INSERT INTO comments(comment, catwis_id, users_id, users_name, created) VALUES(:comment, :catwis_id, :users_id, :users_name, :created)";
$stmt = $dbh->prepare($sql);
$params = array(
  ':comment'=>$_POST['comment'],
  ':catwis_id'=>$_GET['catwis_id'],
  ':users_id'=>$_SESSION['users_id'],
  ':users_name'=>$_SESSION['users_name'],
  ':created'=>date('Y-m-d H:i:s')
);
$stmt->execute($params);

//リロード時の際登録防止
  $url = $_SERVER['REQUEST_URI'];
  header("Location: {$url}");
  exec;
}

//commentを参照
$sql = "SELECT * FROM comments WHERE catwis_id = {$_GET['catwis_id']}";
$result = $dbh->query($sql);
$comment_data = $result->fetchAll();


 ?>
<html>
<head>
<meta charset="UTF-8">
<title>Catwi</title>
<link rel="stylesheet" type="text/css" href="css/catwi_about.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/catwi.js"></script>
<script>
jQuery(function ($) {
function like (event) {
  $.ajax('catwi_likes.php', {
      type: 'get',
      data: {change: event?1:0, catwis_id: <?=$_GET['catwis_id']?>},
      dataType: 'json'
    }
  )
  // 検索成功時にはページに結果を反映
  .done(function(data) {
    console.log(data);
    $a = $("div#catwi_about > a:contains(like)");
    if (data.like) {
      $a.addClass('liked');
    } else {
      $a.removeClass('liked');
    }
    $span = $a.next('span');
    $span.text(data.count);
  })
  // 検索失敗時には、その旨をダイアログ表示
  .fail(function() {
    alert('likeの取得または変更が出来ませんでした。');
  });
}
// 現在のlikeを取得
like(false);
// likeをclickした場合のアクション
$("div#catwi_about > a:contains(like)").click(like);
});
</script>
</head>
<body class="fadeout">
  <div id="wrapper">
  <div id="header">
    <h1>Catwi</h1>
     <img id="ashiato" src="img/ashiato1.png" alt="あしあと">
     <div id="menu">
       <ul>
         <li>
           <a href="home.php">home</a>
         </li>
         <li>
           <a href="mycat.php">myCat</a>
         </li>
         <li>
           <a href="mycatwi.php">myCatwi</a>
         </li>
       </ul>
     </div><!--menu-->
  </div><!--header-->


  <!--Catwi詳細表示例-->
    <?php foreach ($catwi_data as $row): ?>
  <div id="catwi_about">
    <img src="<?= $row['img']?>" alt="猫写真">
    <?php endforeach; ?>

    <a>like</a><span id="like"></span><!--like数カウントアップ仕様にする-->


    <div id="comment" class="clearfix">
      <?php foreach ($comment_data as $row): ?>
      <p><span style="color:#666666; font-weight:bold; font-size:15px; border-bottom: solid 1px #666666;"><?= $row['users_name']?></span>
        <span style="color:#666666; font-weight:bold; font-size:13px;"><?= $row['comment']?></span></p>
    　<?php endforeach; ?>
      <!--ここにDBからコメントを呼び出す-->
    </div>

  </div>

  <form action="<?=$_SERVER['REQUEST_URI'] ?>" method="post"><!--コメント入力フォーム-->
  <div id="comment_form">
    <textarea name="comment" placeholder="コメントを入力"></textarea>
    <input type="submit" value="送信" class="button">
  </div>
  </form>

</div><!--wrapper -->
<div id="footer">
     <img src="img/ashiato1.png" alt="あしあと">
</div><!--footer-->
</body>
</html>
