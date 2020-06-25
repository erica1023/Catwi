<?php
require_once('top.php');

//catwiを登録
require_once('exec_catwi.php');

//usersを参照
$sql = "SELECT * FROM users WHERE id = {$_SESSION['users_id']}";
$result = $dbh->query($sql);
$users_data = $result->fetchAll();


?>
<html>
<head>
<meta charset="UTF-8">
<title>Catwi</title>
<link rel="stylesheet" type="text/css" href="css/mycatwi.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/catwi.js"></script>
<script>
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
           <a id="logout" href='<?=$_SERVER['REQUEST_URI']?>?logout=1'>logout</a>
         </li>
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
  <div id="title" class="clearfix">
    <h2>myCatwi</h2>
  </div><!--title-->

  <?php foreach ($users_data as $row): ?>

  <div id="profile" class="clearfix">
    <img class="icon" src="<?=$row['icon'] ?>" alt="アイコン"><!--アイコン-->
    <div id="profile_text" class="clearfix">
    <p><span style="color:#666666; font-weight:bold; font-size:20px; border-bottom: solid 1px #666666;"><?=$row['name'] ?></span>
      <br><span style="color:#666666; font-size:12px;"><?=$row['profile'] ?></span></p><!--Catwiテキスト-->
    </div>
  </div><!--profile-->

  <?php endforeach; ?>


<?php require_once('catwi_form.php'); ?>

  <!--ここに自分の新規Catwiを表示-->
<?php $only_my_catwis = true; ?>
<?php require_once('catwi_view.php'); ?>



</div><!--wrapper -->
<div id="footer">
     <img src="img/ashiato1.png" alt="あしあと">
</div><!--footer-->
</body>
</html>
