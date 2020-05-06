<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

$count = 0;


if(!isset($_POST['chk'])){
    header();
    echo'fail';
}


for($i = 0; $i < count($_POST['chk']); $i++){
    //加入繫結陣列
    $arrParam = [
        $_POST['chk'][$i]
    ];
    
    //找出特定 member_id 的資料

    $member_id = "SELECT `id` FROM `users` WHERE `id` = ?";
    $stmt_id = $pdo->prepare($member_id);
    $stmt_id->execute($arrParam);

    //有資料，則進行檔案刪除
    if($stmt_id->rowCount() > 0) {
        //取得檔案資料 (單筆)
        $arr = $stmt_id->fetchAll(PDO::FETCH_ASSOC);
        
        //刪除檔案
        // $bool = unlink("../images/multiple_images/".$arr[0]['multipleImageImg']);

        //若檔案刪除成功，則刪除資料
        
            //SQL 語法
            $sql = "DELETE FROM `users` WHERE `id` = ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);
            //累計每次刪除的次數
            $count += $stmt->rowCount();
        // if($bool === true){
            
        // };
    }
}

if($count > 0) {
    header("Refresh: 0; url=../backStage/deleteMembSuccess.php");
    // $objResponse['success'] = true;
    // $objResponse['code'] = 204;
    // $objResponse['info'] = "刪除成功";
    // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    // exit();
} else {
    header("Refresh: 0; url=../backStage/deleteMembFail.php");
    // $objResponse['success'] = false;
    // $objResponse['code'] = 500;
    // $objResponse['info'] = "刪除失敗";
    // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    // exit();
}