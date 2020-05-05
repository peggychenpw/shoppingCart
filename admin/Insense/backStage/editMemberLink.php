<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

$StrSearch[] = $_POST['postId'];
// print_r($_POST); // array 
// print_r($StrSearch); // array 

if (!isset($_POST['postMethod'])) {
    $_POST['postId']="";

}

$sql = "SELECT `id`, `userId`, `name`, `gender`, `birthday`,
                    `userCity`, `address`, `userEmail`,`phoneNumber`,`userImg`,
                    `username`,`pwd`,`userPoint`,`userLoyalty`,`userCreditCard`
        FROM `users` 
        WHERE `id` = ? ";
$stmt = $pdo->prepare($sql);
$stmt->execute($StrSearch);

// print_r($stmt->rowCount());

$obj01 = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
// print_r($obj01['uesrId']);

//資料來源
// $obj01 = [];
// $obj01["name"] = "Darren";
// $obj01["age"] = 18;
// $obj01["height"] = 171;
// $obj01["weight"] = 80;

// $obj02 = [];
// $obj02["name"] = "Alex";
// $obj02["age"] = 21;
// $obj02["height"] = 183;
// $obj02["weight"] = 85;

// 1-1
// if(isset($_GET['getMethod']) && $_GET['getMethod'] === '1'){
//     echo json_encode($obj01);
// } elseif (isset($_POST['postMethod']) && $_POST['postMethod'] === '1'){
//     echo json_encode($obj01[0]);

// }


if(isset($_POST['postId'])){
    echo json_encode($obj01);
}