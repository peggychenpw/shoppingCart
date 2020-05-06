<style>
  .loading-icon {
    position: absolute;
    top: 50%;
    left: calc(50% + 7.5vw);
    transform: translate(-50%, -50%);
  }

  .loading-content {
    border: transparent;
  }
</style>
<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');

//回傳狀態
$objResponse = [];

//SQL 敘述
$sql = "INSERT INTO `items` (`itemName`, `itemSize`,`itemPrice`, `itemQty`, `itemCategoryId`) 
        VALUES (?, ?, ?, ?, ?)";

//繫結用陣列
$arrParam = [
  $_POST['itemName'],
  $_POST['itemSize'],
  $_POST['itemPrice'],
  $_POST['itemQty'],
  $_POST['itemCategoryId']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

$itemCode = sprintf("P%04d", $pdo->lastInsertId());
$itemImg = $itemCode . ".png";

$sqlItemCode =  "UPDATE items 
SET itemId = '{$itemCode}',
    itemImg = '{$itemCode}'
WHERE id = '{$pdo->lastInsertId()}'";
$pdo->query($sqlItemCode);

//為上傳檔案命名
if ($_FILES["itemImg"]["error"] === 0) {

  //若上傳失敗，則回報錯誤訊息
  if (!move_uploaded_file($_FILES["itemImg"]["tmp_name"], "../images/items/{$itemImg}")) {
    $objResponse['success'] = false;
    $objResponse['code'] = 500;
    $objResponse['info'] = "上傳圖片失敗";
    // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
  }
}




if ($stmt->rowCount() > 0) {
  header("Refresh: 1; url=../backStage/admin.php");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">新增成功</span>
    </button>
  </div>
<?php
} else {
  header("Refresh: 1; url=../backStage/admin.php");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">沒有新增資料</span>
    </button>
  </div>
<?php
}
require_once('../templates/footer.php');
