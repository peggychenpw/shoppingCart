<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

echo "<pre>";
print_r($_POST);
echo "</pre>";
exit();

// echo $_POST['bookId'];
// exit();

//回傳狀態
$objResponse = [];

//用在繫結 SQL 用的陣列
$arrParam = [];

//SQL 語法
$sql = "UPDATE `book` SET ";

//bookStatus SQL 語句和資料繫結
$sql .= "`bookStatus` = ? ,";
$arrParam[] = $_POST['bookStatus'];

//bookQty SQL 語句和資料繫結
$sql .= "`bookQty` = ? ";
$arrParam[] = $_POST['bookQty'];

$sql .= "WHERE `bookId` = ? ";
$arrParam[] = $_POST['bookId'];

// echo $_POST['bookId'];
// echo $sql;
// print_r($arrParam);
// exit();

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);


if ($stmt->rowCount() > 0) {
  header("Refresh: 3; url=../backStage/bookEdit.php?page={$_GET['page']}&bookId={$_POST['bookId']}");
  $objResponse['success'] = true;
  $objResponse['code'] = 204;
  $objResponse['info'] = "更新成功";
  echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  exit();
} else {
  header("Refresh: 3; url=../backStage/bookEdit.php?page={$_GET['page']}&bookId={$_POST['bookId']}");
  $objResponse['success'] = false;
  $objResponse['code'] = 400;
  $objResponse['info'] = "沒有任何更新";
  echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  exit();
}
