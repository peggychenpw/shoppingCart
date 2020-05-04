<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$sql = "UPDATE `class` SET 
        `className` = ? ,`classPeopleLimit` = ? ,`classPrice` = ?,`classCategoryId` = ?, `isAlive` = ? ,`classDate` = ?,
        `classTime` = ?
        WHERE `id` = ? ";

$arrParam = [
  $_POST['className'],
  $_POST['classPeopleLimit'],
  $_POST['classPrice'],
  $_POST['classCategoryId'],
  $_POST['classAlive'],
  $_POST['classDate'],
  $_POST['classTime'],
  $_POST['id']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
  echo '<script>alert("修改成功")</script>';
  header("Refresh: 0; url=../backStage/shopClassInfo.php?id={$_POST['id']}");
} else {
  echo '<script>alert("修改失敗")</script>';
  header("Refresh: 0; url=../backStage/shopClassInfo.php?id={$_POST['id']}");
  exit();
}
