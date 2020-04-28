<?php
header("Content-Type: text/html; chartset=utf-8");

//引入判斷是否登入機制
require_once('./checkSession.php');

//引用資料庫連線
require_once('./db.inc.php');

//SQL 敘述
$sql = "INSERT INTO `members` 
        (`member_id`, `member_name`, `member_gender`, `birth_date`, `member_city`, 
         `member_address`, `member_email`,`member_phone`,`member_account`,
         `member_password`,`member_points`,`member_loyalty`,`member_credit_card`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

// if( $_FILES["studentImg"]["error"] === 0 ) {
//     //為上傳檔案命名
//     $studentImg = date("YmdHis");
    
//     //找出副檔名
//     $extension = pathinfo($_FILES["studentImg"]["name"], PATHINFO_EXTENSION);

//     //建立完整名稱
//     $imgFileName = $studentImg.".".$extension;

//     //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
//     if( !move_uploaded_file($_FILES["studentImg"]["tmp_name"], "./files/".$imgFileName) ) {
//         header("Refresh: 3; url=./admin.php");
//         echo "圖片上傳失敗";
//         exit();
//     }
// }

//繫結用陣列
$arr = [
    $_POST['member_id'],
    $_POST['member_name'],
    $_POST['member_gender'],
    $_POST['birth_date'],
    $_POST['member_city'],
    $_POST['member_address'],
    $_POST['member_email'],
    $_POST['member_phone'],
    // $_POST['member_img'],
    $_POST['member_account'],
    $_POST['member_password'],
    $_POST['member_points'],
    $_POST['member_loyalty'],
    $_POST['member_credit_card']    
];

$pdo_stmt = $pdo->prepare($sql);
$pdo_stmt->execute($arr);
if($pdo_stmt->rowCount() === 1) {
    header("Refresh: 3; url=./admin.php");
    echo "新增成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "新增失敗";
}