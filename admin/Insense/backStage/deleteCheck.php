<!-- !!! -->
<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$count = 0;
$arrParam =[
    $_GET['orderId']
];

for($i = 0; $i < count( $arrParam ); $i++){
    //加入繫結陣列
   

    //找出特定 itemId 的資料
    // $sqlImg = "SELECT `orderId` FROM `orders` WHERE `orderId` = ? ";
    // $stmt_img = $pdo->prepare($sqlImg);
    // $stmt_img->execute($arrParam);
      
    // print_r($arrParam);
    //有資料，則進行檔案刪除
    // if($stmt_img->rowCount() > 0) {
        //取得檔案資料 (單筆)
        // $arr = $stmt_img->fetchAll();
        
        //刪除檔案
        // $bool = unlink("../images/items/".$arr[0]['itemImg']);

        //若檔案刪除成功，則刪除資料
        // if(isset($arr)){
            //SQL 語法
            $sql = "DELETE FROM `orders` WHERE `orderId` = ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            //累計每次刪除的次數
            $count += $stmt->rowCount();
        };
//     }
// }

if($count > 0) {
    header("Refresh:3;url=../backStage/admin.php");
    $objResponse['success'] = true;
    $objResponse['code'] = 200;
    $objResponse['info'] = "刪除成功";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh:3;url=../backStage/admin.php");
    $objResponse['success'] = false;
    $objResponse['code'] = 500;
    $objResponse['info'] = "刪除失敗";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}