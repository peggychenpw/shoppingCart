<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$count = 0;
// print_r($_POST);
// exit();
for ($i = 0; $i < count($_POST['chk']); $i++) {
  //加入繫結陣列
  $arrParam = [
    $_POST['chk'][$i]
  ];
  $sql = "DELETE FROM `class` WHERE `id` = ? ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arrParam);

  //累計每次刪除的次數
  $count += $stmt->rowCount();
}
if ($count > 0) {
  echo '<script>alert("刪除成功")</script>';
  header("Refresh: 0;url=../backStage/shopClassManagement.php?page={$_POST['pageNum']}");
  exit();
} else {
  echo '<script>alert("請先勾選再刪除!!!")</script>';
  header("Refresh: 0;url=../backStage/shopClassManagement.php?page={$_POST['pageNum']}");
  exit();
}
