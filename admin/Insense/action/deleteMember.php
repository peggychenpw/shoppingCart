<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

//先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
$sqlGetImg = "SELECT `userImg` FROM `users` WHERE `id` = ? ";


//加入繫結陣列
$arrGetImgParam = [
    (int)$_GET['deleteId']
];

$stmtGetImg = $pdo->prepare($sqlGetImg);
$stmtGetImg->execute($arrGetImgParam);

//若有找到 studentImg 的資料
if($stmtGetImg->rowCount() > 0) {
    //取得指定 id 的學生資料 (1筆)
    $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC)[0];

    //若是 members 裡面不為空值，代表過去有上傳過
    if($arrImg['userImg'] !== NULL){
        //刪除實體檔案
        @unlink("../images/members/".$arrImg['userImg']);
    }     
}

//SQL 語法
$sql = "DELETE FROM `users` WHERE `id` = ? ";

$arrParam = [
    (int)$_GET['deleteId']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);


if($stmt->rowCount() > 0) {
    header("Refresh: 0; url=../backStage/deleteMembSuccess.php");
    // echo "刪除成功";
} else {
    header("Refresh: 0; url=../backStage/deleteMembFail.php");
    // echo "刪除失敗";
}