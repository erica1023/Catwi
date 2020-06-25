<?php

$user = 'root';
$pass = 'root';
$dbh = new PDO('mysql:host=localhost;dbname=catwi', $user, $pass);



session_start();

// unset($_SESSION['login_session']);
#---------- ログインしているかどうかの確認 -------------#

if (!empty($_SESSION['login_session'])) {

    if (!empty($_GET['logout'])) {
        unset($_SESSION['login_session']);
        $url = parse_url($_SERVER['REQUEST_URI']);
        unset($url['query']);
        header("Location: {$url['path']}");
        exit;
    } else {
        return;
    }
}


#---------- 以降はログインしていない場合 -------------#

$email = empty($_POST['email']) ? null : $_POST['email'];
$password = empty($_POST['password']) ? null : $_POST['password'];

function validate_user($email, $password) {

  $user = 'root';
  $pass = 'root';
  $dbh = new PDO('mysql:host=localhost;dbname=catwi', $user, $pass);


$sql = "SELECT count(*) FROM users WHERE email='$email' AND password='$password'";
$result = $dbh->query($sql);

  if ($result->fetchColumn() > 0) {
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $dbh->query($sql);

    $users = $result->fetch(PDO::FETCH_ASSOC);

    $_SESSION['login_session'] = true;
    $_SESSION['users_id'] = $users['id'];
    $_SESSION['users_name'] = $users['name'];

    return true;
}
return false;


}


if ($email !== null) {
    if (validate_user($email, $password)) {
        return;
    }
    $message
        =   '<div style="color:red;margin:1em 0.5em -2em 2em">'
            . 'emailまたはpasswordが間違っています'
            . '</div>';
} else {
    $message = '';
}

?>
<html>
<head>
<meta charset="UTF-8">
<title>Catwi</title>
<link rel="stylesheet" type="text/css" href="css/top.css">
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
    <h2>login</h2>
  </div><!--title-->
  <div id="login">
    <form action="<?=$_SERVER['REQUEST_URI'] ?>" method="post">
      <?=$message?>
      <dl class="clearfix">
        <dt>email</dt>
        <dd><input type="text" name="email" value="<?=$email?>"></dd>
        <dt>password</dt>
        <dd><input type="password" name="password" value="<?=$password?>"></dd>
        <input type="submit" value="login" class="button">
      </dl>
    </form>
  </div><!--login-->
  <div id="new">
    <a href="new_account.php">新規アカウント登録</a>
  </div><!--new-->
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

<?php
exit;
