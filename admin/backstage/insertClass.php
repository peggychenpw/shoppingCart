<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$sql = "INSERT INTO `class` ( `classId`,`className`,`classPrice`,`classPeopleLimit`,
                             `classCategoryId`,`classDate`,`classTime`) 
        VALUES (?,?,?,?,?,?,?)";

$lastIdQuery = "SELECT `id` FROM `class` ORDER BY `id` DESC LIMIT 1 ";
$result = $pdo->prepare($lastIdQuery);
$result->execute();
$row = $result->fetchAll(PDO::FETCH_ASSOC)[0]['id'];

$classId = ($row >= 10) ? 'C_0' . ($row + 1) : 'C_00' . ($row + 1);
$arrParam = [
  $classId,
  $_POST['className'],
  $_POST['classPrice'],
  $_POST['classPeopleLimit'],
  $_POST['classCategory'],
  $_POST['classDate'],
  $_POST['classTime'] . ':' . '00'
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
  header("Refresh: 0; url=./classManagement.php");
  exit();
}
