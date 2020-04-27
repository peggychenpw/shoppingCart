<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$sql = "INSERT INTO `class` ( `className`,`classPrice`,`classPeopleLimit`,
                             `classCategoryId`,`classDate`,`classTime`) 
        VALUES (?,?,?,?,?,?)";

$arrParam = [
  $_POST['className'],
  $_POST['classPrice'],
  $_POST['classPeopleLimit'],
  $_POST['classCategory'],
  $_POST['classDate'],
  $_POST['classTime'] . ':' . '00'
];
// $lastIdQuery = "SELECT `id` FROM `class` ORDER BY `id` DESC LIMIT 1 ";
// $result = $pdo->prepare($sql);
// $result->execute();
// $row = $result->fetchAll(PDO::FETCH_ASSOC)[0]['id'];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);
echo $pdo->lastInsertId();

$classCode = sprintf("C_%d", $pdo->lastInsertId());
$sqlItemCode = "UPDATE `class`
SET `classId` = '{$classCode}'
WHERE `id` = '{$pdo->lastInsertId()}' ";

$classId = ($row >= 10) ? 'C_0' . ($row + 1) : 'C_00' . ($row + 1);


$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
  header("Refresh: 0; url=../backStage/classManagement.php");
  exit();
}
