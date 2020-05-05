<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
error_reporting(0);

$count = 0;
for($i = 0; $i < count($_POST['chk']); $i++){
    //加入繫結陣列
    $arrParam = [
        $_POST['chk'][$i]
    ];
     
            //SQL 語法
            $sql = "DELETE FROM `coupon` WHERE `couponId` = ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            //累計每次刪除的次數
            $count += $stmt->rowCount();
       
    }
// }
if($count > 0) {
    header("Refresh: 0; url=./adminCoupon.php");
    // $objResponse['success'] = true;
    // $objResponse['code'] = 200;
    // $objResponse['info'] = "新增成功";
    // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh: 2; url=./adminCoupon.php");
     echo "<script type='text/javascript'>alert(`刪除失敗`);</script>";

    exit();
}