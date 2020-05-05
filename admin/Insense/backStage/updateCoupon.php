<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();


//回傳狀態
$objResponse = [];

//用在繫結 SQL 用的陣列
$arrParam = [];


//SQL 語法
$sql = "UPDATE `coupon` SET ";

//itemName SQL 語句和資料繫結
$sql .= "`couponName` = ? ,";
$arrParam[] = $_POST['couponName'];


//itemQty SQL 語句和資料繫結
$sql .= "`couponCode` = ? , ";
$arrParam[] = $_POST['couponCode'];

//itemCategoryId SQL 語句和資料繫結
$sql .= "`couponDiscount` = ? , ";
$arrParam[] = $_POST['couponDiscount'];

$sql .= "`couponStart` = ? ,";
$arrParam[] = $_POST['couponStart'];

$sql .= "`couponEnd` = ? ";
$arrParam[] = $_POST['couponEnd'];

$sql .="WHERE`couponId`= ? ";
$arrParam[] = $_POST['couponId'];


$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);



if ($stmt->rowCount() > 0) {
  header("Refresh: 0; url=./adminCoupon.php?couponId={$_POST['couponId']}");
  $objResponse['success'] = true;
  $objResponse['code'] = 204;
  $objResponse['info'] = "更新成功";
  echo json_encode($objResponse, JSON_UNESCAPED_UNICODE); 
  exit();
} else {
  header("Refresh: 0; url=./editCoupon.php?couponId={$_POST['couponId']}");
  $objResponse['success'] = false;
  $objResponse['code'] = 400;
  $objResponse['info'] = "沒有任何更新";
  echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  exit();
}
