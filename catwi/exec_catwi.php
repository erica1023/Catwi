<?php
//catwiを登録
if(isset($_POST['catwi_text'])) {
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
  $sql = "INSERT INTO catwis(catwi_text, img, users_id, created) VALUES(:catwi_text, :img, :users_id, :created)";
  $stmt = $dbh->prepare($sql);
  $params = array(
    ':catwi_text'=>$_POST['catwi_text'],
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
