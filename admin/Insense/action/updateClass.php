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
  header("Refresh: 3; url=../backStage/classInfo.php?id={$_POST['id']}");
} else {
  header("Refresh: 0; url=../backStage/classInfo.php?id={$_POST['id']}");
  exit();
}
?>
<div class="spinner-grow text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-danger" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-warning" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-info" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-light" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-dark" role="status">
  <span class="sr-only">Loading...</span>
</div>