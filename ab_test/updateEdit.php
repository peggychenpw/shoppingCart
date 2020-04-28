<?php
//引入判斷是否登入機制
require_once('./checkSession.php');

//引用資料庫連線
require_once('./db.inc.php');

/**
 * 注意：
 * 
 * 因為要判斷更新時檔案有無上傳，
 * 所以要先對前面/其它的欄位先進行 SQL 語法字串連接，
 * 再針對圖片上傳的情況，給予對應的 SQL 字串和資料繫結設定。
 * 
 */

// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
// exit();

//先對其它欄位，進行 SQL 語法字串連接
$sql = "UPDATE `members` 
        SET 
        `member_id` = ?, 
        `member_name` = ?,
        `birth_date` = ?,
        `member_img` = ?,
        `member_phone` = ?,
        `member_email` = ?, 
        `member_address` = ?,
        `member_city` = ?,
        `member_account` = ?,
        `member_password` = ?,
        `member_credit_card` = ?, 
        `member_points` = ?,
        `member_loyalty` = ?,
        `member_gender` = ? ";

//先對其它欄位進行資料繫結設定
$arrParam = [
    $_POST['member_id'],
    $_POST['member_name'],
    $_POST['birth_date'],
    $_POST['member_img'],
    $_POST['member_phone'],
    $_POST['member_email'],
    $_POST['member_address'],
    $_POST['member_city'],
    $_POST['member_account'],
    $_POST['member_password'],
    $_POST['member_credit_card'],
    $_POST['member_points'],
    $_POST['member_loyalty'],
    $_POST['member_gender']   
];

//判斷檔案上傳是否正常，error = 0 為正常
// if( $_FILES["studentImg"]["error"] === 0 ) {
//     //為上傳檔案命名
//     $strDatetime = date("YmdHis");
        
//     //找出副檔名
//     $extension = pathinfo($_FILES["studentImg"]["name"], PATHINFO_EXTENSION);

//     //建立完整名稱
//     $studentImg = $strDatetime.".".$extension;

//     //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
//     if( move_uploaded_file($_FILES["studentImg"]["tmp_name"], "./files/".$studentImg) ) {
//         /**
//          * 刪除先前的舊檔案: 
//          * 一、先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
//          * 二、刪除實體檔案
//          * 三、更新成新上傳的檔案名稱
//          *  */ 

//         //先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
//         $sqlGetImg = "SELECT `studentImg` FROM `students` WHERE `id` = ? ";
//         $stmtGetImg = $pdo->prepare($sqlGetImg);

//         //加入繫結陣列
//         $arrGetImgParam = [
//             (int)$_POST['editId']
//         ];

//         //執行 SQL 語法
//         $stmtGetImg->execute($arrGetImgParam);

//         //若有找到 studentImg 的資料
//         if($stmtGetImg->rowCount() > 0) {
//             //取得指定 id 的學生資料 (1筆)
//             $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC)[0];

//             //若是 studentImg 裡面不為空值，代表過去有上傳過
//             if($arrImg[0]['studentImg'] !== NULL){
//                 // 刪除實體檔案
//                 // @有強壓的意思，unlink會回傳true或false，
//                 // 加上@則不館unlink回傳什麼，就是執行就對了。
//                 @unlink("./files/".$arrImg['studentImg']);
//             } 
            
//             /**
//              * 因為前面 `studentDescription` = ? 後面沒有加「,」，
//              * 若是這裡會有更新 studentImg 的需要，
//              * 代表 `studentDescription` = ? 後面缺一個「,」，
//              * 不然會報錯
//              */
//             $sql.= ",";

//             //studentImg SQL 語句字串
//             $sql.= "`studentImg` = ? ";

//             //僅對 studentImg 進行資料繫結
//             $arrParam[] = $studentImg;
            
//         }
//     }
// }

//SQL 結尾
$sql.= "WHERE `id` = ? ";
$arrParam[] = (int)$_POST['editId'];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if( $stmt->rowCount() > 0 ){
    // 3秒後更新，url導向新的頁面後面給編號
    header("Refresh: 3; url=./admin.php");
    echo "更新成功";
} else {
    header("Refresh: 3; url=./edit.php?editId=".(int)$_POST['editId']);
    echo "沒有任何更新";
}