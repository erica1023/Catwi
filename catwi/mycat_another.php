<?php
require_once('top.php');


//catを参照
$sql = "SELECT * FROM cats WHERE users_id = {$_GET['users_id']}";
$result = $dbh->query($sql);
$cat_data = $result->fetchAll();

//userを参照
$sql = "SELECT * FROM users WHERE id = {$_GET['users_id']}";
$result = $dbh->query($sql);
$users_data = $result->fetchAll();


?>

<html>
<head>
<meta charset="UTF-8">
<title>Catwi</title>
<link rel="stylesheet" type="text/css" href="css/mycat.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/catwi.js"></script>
<script></script>
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

  <?php foreach ($users_data as $row): ?>

  <div id="title" class="clearfix">
    <h2><?=$row['name'] ?>さんのmyCat</h2><!--？？？？？にnameいれる-->
  </div><!--title-->
  <div id="profile" class="clearfix">
    <img class="icon" src="<?=$row['icon'] ?>" alt="アイコン"><!--アイコン-->
    <div id="profile_text" class="clearfix">
    <p><span style="color:#666666; font-weight:bold; font-size:20px; border-bottom: solid 1px #666666;"><?=$row['name'] ?></span>
      <br><span style="color:#666666; font-size:12px;"><?=$row['profile'] ?></span></p><!--Catwiテキスト-->
    </div>
  </div><!--profile-->

 <?php endforeach; ?>

  <!--ここにmyCatを表示-->

  <?php foreach ($cat_data as $row): ?>

  <!--myCat表示例-->
  <div id="mycat">
    <div id="icon_margin">
    <img class="icon" src=<?=$row['img'] ?> alt="アイコン">
  </div>
    <div class="cat_profile">
      <p>
        <span style="color:#666666;font-size:12px;border-bottom: solid 1px #666666;">myCatのお名前 -name-</span>
        <span style="color:#666666;font-size:15px;"><?=$row['name']?><br></span>
        <span style="color:#666666;font-size:12px;border-bottom: solid 1px #666666;">myCatの性別 -sex-</span>
        <span style="color:#666666;font-size:15px;"><?=$row['sex']?><br></span>
        <span style="color:#666666;font-size:12px;border-bottom: solid 1px #666666;">myCatの年齢 -age-</span>
        <span style="color:#666666;font-size:15px;"><?=$row['age']?><br></span>
        <span style="color:#666666;font-size:12px;border-bottom: solid 1px #666666;">myCatの特徴 -character-</span>
        <span style="color:#666666;font-size:15px;"><br><?=$row['profile']?><br></span>
      </p><!--Catwiテキスト-->
    </div>
  </div>

  <?php endforeach; ?>

</div><!--wrapper -->
<div id="footer">
     <img src="img/ashiato1.png" alt="あしあと">
</div><!--footer-->
</body>
</html>
