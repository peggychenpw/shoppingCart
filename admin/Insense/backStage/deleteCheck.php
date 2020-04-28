<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
?>

<?php
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>

<?php
$count = 0;

if (!isset($_POST['chk'])) {
    header('refresh:3;url=./orders.php');
?>
    
        <div class="con">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">訂單一覽</div>
                <div class="card-body">
                    <span class="badge badge-warning">Warning</span>
                    <p class="card-text">請先勾選要刪除訂單</p>
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </div>
        </div>
<?php
    exit();
}
?>

<?php
require_once('../templates/footer.php');
?>


<?php
for ($i = 0; $i < count($_POST['chk']); $i++) {
    //加入繫結陣列
    $arrParam = [
        $_POST['chk'][$i]
    ];

    // echo "<pre>";
    // print_r($arrParam);
    // echo "</pre>";
    // exit();


    //找出特定 itemId 的資料
    $sqlImg = "SELECT `orderId` FROM `orders` WHERE `orderId` = ? ";
    $stmt_img = $pdo->prepare($sqlImg);
    $stmt_img->execute($arrParam);
    // echo "<pre>";
    // print_r($stmt_img);
    // echo "</pre>";
    // exit();

    //有資料，則進行檔案刪除
    if ($stmt_img->rowCount() > 0) {
        //取得檔案資料 (單筆)
        $arr = $stmt_img->fetchAll();
        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";
        // exit();

        //刪除檔案
        // $bool = unlink("../images/items/" . $arr[0]['itemImg']);

        //若檔案刪除成功，則刪除資料
        if (isset($arr)) {
            //SQL 語法
            $sql = "DELETE FROM `orders` WHERE `orderId` = ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($arrParam);

            //累計每次刪除的次數
            $count += $stmt->rowCount();
        };
    }
}

if ($count > 0) {
    header("Refresh: 10; url=./orders.php");
    $objResponse['success'] = true;
    $objResponse['code'] = 200;
    $objResponse['info'] = "刪除成功";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
} else {
    header("Refresh: 10; url=./orders.php");
    $objResponse['success'] = false;
    $objResponse['code'] = 500;
    $objResponse['info'] = "刪除失敗";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
}
?>