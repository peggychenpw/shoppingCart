<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

// echo $_GET['page'];
// exit();
$count = 0;
for ($i = 0; $i < count($_POST['chk']); $i++) {
  //加入繫結陣列
  $arrParam = [
    $_POST['chk'][$i]
  ];
  // print_r($arrParam);
  
  //SQL 語法
  $sql = "DELETE FROM `book` WHERE `bookId` = ? ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arrParam);
  $count += $stmt->rowCount();
}
// exit();

//累計每次刪除的次數
if ($count > 0) {
  header("Refresh: 1; url=../backStage/bookSearch2.php?page={$_GET['page']}");
  $objResponse['success'] = true;
  $objResponse['code'] = 200;
  $objResponse['info'] = "刪除成功";
  // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  exit();
} else {
  header("Refresh: 1; url=../backStage/bookSearch2.php?page={$_GET['page']}");
  $objResponse['success'] = false;
  $objResponse['code'] = 500;
  $objResponse['info'] = "刪除失敗";
  // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  exit();
}
