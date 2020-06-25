<?php
require_once('top.php');

//catを登録
if(isset($_POST['profile'])) {
  function save_image() {
    if (empty($_FILES['img']['tmp_name'])) {
      return '';
    }
    $file = $_FILES['img'];
    $dir = dirname(__FILE__) . '/post_images/';
    $urlbase = 'post_images/';

    $tmp = preg_split('#/#', $file['type']);
    $type =  array_pop($tmp);

    $name = md5_file($file['tmp_name']) . '.' . $type;
    $path = $dir . $name ;

    move_uploaded_file($file['tmp_name'], $path);

    return $urlbase . $name;
  }


  $path = save_image();
  // echo "post";
  $sql = "INSERT INTO cats(name, sex, age, profile, img, users_id, created) VALUES(:name, :sex, :age, :profile, :img, :users_id, :created)";
  $stmt = $dbh->prepare($sql);
  $params = array(
    ':name'=>$_POST['name'],
    ':sex'=>$_POST['sex'],
    ':age'=>$_POST['age'],
    ':profile'=>$_POST['profile'],
    ':img'=>$path,
    ':users_id'=>$_SESSION['users_id'],
    ':created'=>date('Y-m-d H:i:s')
  );
  $stmt->execute($params);

  //リロード時の際登録防止
    $url = $_SERVER['REQUEST_URI'];
    header("Location: {$url}");
    exec;
  }

//catsを参照
$sql = "SELECT * FROM cats WHERE users_id = {$_SESSION['users_id']} ORDER BY id DESC LIMIT 50";
$result = $dbh->query($sql);
$cat_data = $result->fetchAll();

//usersを参照
$sql = "SELECT * FROM users WHERE id = {$_SESSION['users_id']}";
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
    <h2>myCat</h2>
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

  <form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI'] ?>"method="post"><!--cat入力フォーム-->
  <div id="cat_form" class="clearfix">
    <div id="text">
      <input type="text" name="name" placeholder="myCatのお名前 -name-">
      <input type="text" name="sex" placeholder="myCatの性別 -sex-">
      <input type="text" name="age" placeholder="myCatの年齢 -age-">
    </div>
    <textarea name="profile" placeholder="myCatの特徴 -character-"></textarea>
    <label class="upload_label">
      画像を選択
    <input name="img" type="file" accept=".png, .jpg, .jpeg" required>
    </label>
    <input type="submit" value="myCat登録" class="button">
  </div>
  </form>

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
