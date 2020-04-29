<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

//回傳狀態
$objResponse = [];

//判斷有無這個使用者存在
$sqlCheckUser = "SELECT `userName`
                 FROM `users`
                 WHERE `userId` = ? ";

$arrCheck = [
    $_POST['userId']
];

$stmtCheck = $pdo->prepare($sqlCheckUser);
$stmtCheck->execute($arrCheck);

if($stmtCheck->rowCount() == 0){
    header("Refresh: 1; url=../backStage/bookNew.php");
    echo "沒有該使用者";
    exit();
}

//找課程價格
$sqlFindClass = "SELECT `classPrice`, `classPeopleLimit`
                 FROM `class`
                 WHERE `classId` = ? ";

$arrFindClass = [
    $_POST['classChoice']
];

$stmtFindclass = $pdo->prepare($sqlFindClass);
$stmtFindclass->execute($arrFindClass);

$arrFindClass = $stmtFindclass->fetchAll(PDO::FETCH_ASSOC)[0];

$bookPrice = $arrFindClass['classPrice'];
$classPeopleLimit = $arrFindClass['classPeopleLimit'];
echo $bookPrice;
echo $classPeopleLimit;

//找目前上課人數
$sqlFindPeople = "SELECT `bookQty`
                  FROM `book`
                  WHERE `classId` = '{$_POST['classChoice']}'
                  AND `bookStatus` = '成功'";

echo $sqlFindPeople;
$stmtFindPeople = $pdo->query($sqlFindPeople);
$arrFindPeople = $stmtFindPeople->fetchAll(PDO::FETCH_ASSOC);

$currentPeople = 0;

// for ($i;)

echo "<pre>";
print_r($arrFindPeople);
echo "</pre>";

exit();

//SQL 敘述
$sql = "INSERT INTO `book` (`classId`, `userId`, `bookStatus`, `bookQty`,`bookPrice`) 
        VALUES (?, ?, ?, ?, ?)";

//繫結用陣列
$arrParam = [
  $_POST['classChoice'],
  $_POST['userId'],
  "成功",
  $_POST['bookQty'],
  $bookPrice
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
  header("Refresh: 1; url=../backStage/bookNew.php");
  $objResponse['success'] = true;
  $objResponse['code'] = 200;
  $objResponse['info'] = "新增成功";
  echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
} else {
  header("Refresh: 1; url=../backStage/bookNew.php");
  $objResponse['success'] = false;
  $objResponse['code'] = 500;
  $objResponse['info'] = "沒有新增資料";
  echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  exit();
};


$bookId = sprintf("B%05d",$pdo->lastInsertId());
$sqlUpdateClassId =  "UPDATE `book` 
SET `bookId` = '{$bookId}'
WHERE `id` = '{$pdo->lastInsertId()}'";
$pdo->query($sqlUpdateClassId);

echo $bookId;