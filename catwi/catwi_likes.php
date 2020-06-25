<?php
# like値の取得
function get_like_value($dbh, $users_id, $catwis_id) {
  $where = "WHERE users_id={$users_id} AND catwis_id={$catwis_id}";
  $sql = "SELECT count(*) FROM likes {$where}";
  $result = $dbh->query($sql);
  if ($result->fetchColumn() > 0) {
    $sql = "SELECT catwi_like FROM likes {$where}";
    $result = $dbh->query($sql);
    $like = $result->fetchColumn();
  }
  return empty($like)?0:1;
}

# like値の変更
function change_like_value($dbh, $users_id, $catwis_id) {
  $where = "WHERE users_id={$users_id} AND catwis_id={$catwis_id}";
  $sql = "SELECT count(*) FROM likes {$where}";
  $result = $dbh->query($sql);
  if ($result->fetchColumn() > 0) {
    $sql = "UPDATE likes SET catwi_like = 1 - catwi_like {$where}";
    $dbh->query($sql);
    error_log(print_r($dbh->errorInfo(),true));
  } else {
    $sql = "INSERT INTO likes(users_id, catwis_id, catwi_like) VALUES(:users_id, :catwis_id, :catwi_like)";
    $stmt = $dbh->prepare($sql);
    $params = array(
      ':users_id' => $users_id,
      ':catwis_id' => $catwis_id,
      ':catwi_like' => 1,
    );
    $stmt->execute($params);
  }
}

# like数
function get_like_count($dbh, $catwis_id) {
  $where = "WHERE catwis_id={$catwis_id} AND catwi_like=1";
  $sql = "SELECT count(*) FROM likes {$where}";
  $result = $dbh->query($sql);
  return $result->fetchColumn();
}

# jsonヘッダー
header('Content-type:application/json; charset=utf8');

# 設定する値
session_start();
$users_id = $_SESSION['users_id'];
$catwis_id = $_GET['catwis_id'];
$change = $_GET['change'];

# DB接続
$user = 'root';
$pass = 'root';
$dbh = new PDO('mysql:host=localhost;dbname=catwi', $user, $pass);

if ($change) {
  change_like_value($dbh, $users_id, $catwis_id);
}

$result = array(
  'like' => get_like_value($dbh, $users_id, $catwis_id),
  'count' => get_like_count($dbh, $catwis_id),
);

echo json_encode($result);
