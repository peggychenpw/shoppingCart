<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

//SQL 敘述
$sql = "INSERT INTO `users` 
        (`userId`, `name`, `gender`, `birthday`, `userCity`, 
         `address`, `userEmail`,`phoneNumber`,`userImg`,`username`,
         `pwd`,`userPoint`,`userLoyalty`,`userCreditCard`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$imgFileName = "";
if ($_FILES["userImg_new"]["error"] === 0) {
  //為上傳檔案命名
  $userImg = date("YmdHis");

  //找出副檔名
  $extension = pathinfo($_FILES["userImg_new"]["name"], PATHINFO_EXTENSION);

  //建立完整名稱
  $imgFileName = $userImg . "." . $extension;

  //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
  if (!move_uploaded_file($_FILES["userImg_new"]["tmp_name"], "../images/members/" . $imgFileName)) {
    header("Refresh: 3; url=../backStage/members.php");
    echo "圖片上傳失敗";
    exit();
  }
}

//繫結用陣列
$arr = [
  $_POST['userId_new'],
  $_POST['name_new'],
  $_POST['gender_new'],
  $_POST['birthday_new'],
  $_POST['userCity_new'],
  $_POST['address_new'],
  $_POST['userEmail_new'],
  $_POST['phoneNumber_new'],
  $imgFileName,
  $_POST['username_new'],
  sha1($_POST['pwd_new']),
  $_POST['userPoint_new'],
  $_POST['userLoyalty_new'],
  $_POST['userCreditCard_new']
];


$stmt = $pdo->prepare($sql);
$stmt->execute($arr);
if ($stmt->rowCount() === 1) {

  header("Refresh: 3; url=../backStage/members.php");
  echo "新增成功";
} else {
  header("Refresh: 10; url=../backStage/members.php");
  echo "新增失敗";
}
