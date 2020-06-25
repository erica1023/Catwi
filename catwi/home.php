<?php
require_once('top.php');

//catwiを登録
require_once('exec_catwi.php');

?>
<html>
<head>
<meta charset="UTF-8">
<title>Catwi</title>
<link rel="stylesheet" type="text/css" href="css/home.css">
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
    <h2>home</h2>
  </div><!--title-->

<?php require_once('catwi_form.php'); ?>

  <!--ここに全アカウントの新規Catwiを表示-->
<?php require_once('catwi_view.php'); ?>

   </div><!--wrapper -->
   <div id="footer">
        <img src="img/ashiato1.png" alt="あしあと">
   </div><!--footer-->
 </body>
 </html>
