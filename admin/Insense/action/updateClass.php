<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$sql = "UPDATE `class` SET 
        `className` = ? ,`classPeopleLimit` = ? ,`classPrice` = ?,`classCategoryId` = ?,`classDate` = ?,
        `classTime` = ?
        WHERE `id` = ? ";

$arrParam = [
  $_POST['className'],
  $_POST['classPeopleLimit'],
  $_POST['classPrice'],
  $_POST['classCategoryId'],
  $_POST['classDate'],
  $_POST['classTime'],
  $_POST['id']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
  header("Refresh: 3; url=../backStage/classInfo.php?id={$_POST['id']}");
  $objResponse['success'] = true;
  $objResponse['code'] = 204;
  $objResponse['info'] = "更新成功";
  echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  exit();
} else {
  header("Refresh: 3; url=../backStage/classInfo.php?id={$_POST['id']}");
  $objResponse['success'] = false;
  $objResponse['code'] = 400;
  $objResponse['info'] = "沒有任何更新";
  echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  exit();
}
