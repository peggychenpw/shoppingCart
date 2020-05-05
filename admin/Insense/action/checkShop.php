<?php
session_start(); //啟動 session
require_once('../action/db.inc.php');
//判斷是否登入 (確認先前指派的 session 索引是否存在)
if (!isset($_SESSION['username'])) {
  //3 秒後跳頁
  header("Refresh: 0; url=../backStage/log.php");
  echo "<script>請確實登入</script>";
  exit();
}

$sql = "SELECT `shop`.`shopId`
        FROM `shop`
        WHERE `shop`.`username` = '{$_SESSION['username']}'";

$stmt = $pdo->query($sql);
if ($stmt->rowCount() == 0) {
  header("Refresh: 3; url=../backStage/log.php");
  echo "您無權使用該網頁…3秒後自動回登入頁";
  exit();
}
