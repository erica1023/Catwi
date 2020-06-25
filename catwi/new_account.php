<?php
try {


//userを登録
if(isset($_POST['password'])) {
  function save_image() {
    if (empty($_FILES['icon']['tmp_name'])) {
      return '';
    }
    $file = $_FILES['icon'];
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

  //リロード時の際登録防止
    $url = $_SERVER['REQUEST_URI'];
    header("Location: {$url}");
    exec;


  $user = 'root';
  $pass = 'root';
  $dbh = new PDO('mysql:host=localhost;dbname=catwi', $user, $pass);


  $sql = "INSERT INTO users(name, email, password, profile, icon, created) VALUES(:name, :email, :password, :profile, :icon, :created)";
  $stmt = $dbh->prepare($sql);
  $params = array(
    ':name'=>$_POST['name'],
    ':email'=>$_POST['email'],
    ':password'=>$_POST['password'],
    ':profile'=>$_POST['profile'],
    ':icon'=>$path,
    ':created'=>date('Y-m-d H:i:s')
  );
  $stmt->execute($params);
}

} catch (PDOException $e) {
    print "error: " . $e->getMessage();
    die();
}



 ?>
<html>
<head>
<meta charset="UTF-8">
<title>Catwi</title>
<link rel="stylesheet" type="text/css" href="css/new_account.css">
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
  </div><!--header-->
  <div id="title" class="clearfix">
    <h2>entry</h2>
  </div><!--title-->

  <div id="entry">

    <form enctype="multipart/form-data"　action="home.php" method="post"><!--入力フォーム-->
      <div id="new_account_form" class="clearfix">
        <div id="text">
          <input type="text" name="name" placeholder="お名前 -name-">
          <input type="text" name="email" placeholder="メールアドレス -email address-">
          <input type="password" name="password" placeholder="パスワード -password-">
        </div>
        <textarea name="profile" placeholder="自己紹介 -profile-"></textarea>
        <label class="upload_label">
          プロフィール画像を選択
        <input name="icon" type="file" accept=".png, .jpg, .jpeg">
        </label>
        <input type="submit" value="新規アカウント登録" class="button">
      </div>
      </form>
  </div><!--entry-->

  <div id="about" class="clearfix">
    <h3>Catwiについて</h3>
    <p>Catwi(きゃつい)とは、猫好きによる猫好きのための猫情報専門のSNSです。<br>
      Catwiと呼ばれる半角280文字全角140文字以内のメッセージや画像を投稿できます。<br>
      また、猫のプロフィールをmyCatとして登録することも可能です。
    </p>
  </div><!--about-->
  <div id="footer" class="clearfix">
       <img src="img/ashiato1.png" alt="あしあと">
  </div><!--footer-->
 </div><!--wrapper -->
 </body>
 </html>
