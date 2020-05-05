<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

//回傳狀態




//SQL 敘述
$sql = "INSERT INTO `coupon` (`couponName`,`couponCode`, `couponDiscount`, `couponStart`, `couponEnd`) 
        VALUES (?, ?, ?, ?, ?)";

// print_r($_POST);
// exit();
//繫結用陣列
$arrParam = [
    $_POST['couponName'],
    $_POST['couponCode'],
    $_POST['couponDiscount'],
    $_POST['couponStart'],
    $_POST['couponEnd']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);


if($stmt->rowCount() > 0) {
    header("Refresh: 0; url=./adminCoupon.php");
    // $objResponse['success'] = true;
    // $objResponse['code'] = 200;
    // $objResponse['info'] = "新增成功";
    // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    //echo '<script language="javascript">';
    //echo 'alert("新增成功")';
    //echo '</script>';
    
    exit();
} else {
    header("Refresh: 0; url=./createCoupon.php");
    echo "<script type='text/javascript'>alert(`沒有新增資料`);</script>";
    exit();
}