<?php
header("Content-Type: text/html; chartset=utf-8");

//引入判斷是否登入機制
require_once('./checkSession.php');

//引用資料庫連線
require_once('./db.inc.php');

//SQL 敘述
$sql = "INSERT INTO `users` 
        (`userId`, `name`, `gender`, `birthday`, `userCity`, 
         `address`, `userEmail`,`phoneNumber`,`userImg`,`username`,
         `pwd`,`userPoint`,`userLoyalty`,`userCreditCard`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

if( $_FILES["userImg"]["error"] === 0 ) {
    //為上傳檔案命名
    $userImg = date("YmdHis");
    
    //找出副檔名
    $extension = pathinfo($_FILES["userImg"]["name"], PATHINFO_EXTENSION);

    //建立完整名稱
    $imgFileName = $userImg.".".$extension;

    //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if( !move_uploaded_file($_FILES["userImg"]["tmp_name"], "./files/".$imgFileName) ) {
        header("Refresh: 3; url=./admin.php");
        echo "圖片上傳失敗";
        exit();
    }
}

//繫結用陣列
$arr = [
    $_POST['userId'],
    $_POST['name'],
    $_POST['gender'],
    $_POST['birthday'],
    $_POST['userCity'],
    $_POST['address'],
    $_POST['userEmail'],
    $_POST['phoneNumber'],
    $imgFileName,
    $_POST['username'],
    $_POST['pwd'],
    $_POST['userPoint'],
    $_POST['userLoyalty'],
    $_POST['userCreditCard']    
];

// print_r($arr);
// exit();
$stmt = $pdo->prepare($sql);
$stmt->execute($arr);
if($stmt->rowCount() === 1) {
    header("Refresh: 3; url=./admin.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "新增失敗";
}