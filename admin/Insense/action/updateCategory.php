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
$objResponse = [];

//若沒填寫商品種類時的行為
if ($_POST['categoryName'] == '') {
  header("Refresh: 1; url=../backStage/editCategory.php?editCategoryId={$_POST["editCategoryId"]}");
  // $objResponse['success'] = false;
  // $objResponse['code'] = 400;
  // $objResponse['info'] = "請填寫商品種類";
  // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">請填寫商品種類</span>
    </button>
  </div>
<?php
}

$sql = "UPDATE `categories` SET `categoryName` = ? WHERE `categoryId` = ?";
$stmt = $pdo->prepare($sql);
$arrParam = [
  $_POST['categoryName'],
  $_POST["editCategoryId"]
];
$stmt->execute($arrParam);
if ($stmt->rowCount() > 0) {
  header("Refresh: 1; url=../backStage/category.php");
  // $objResponse['success'] = true;
  // $objResponse['code'] = 204;
  // $objResponse['info'] = "更新成功";
  // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  // exit();
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">更新成功</span>
    </button>
  </div>
<?php
} else {
  header("Refresh: 1; url=../backStage/editCategory.php?editCategoryId={$_POST["editCategoryId"]}");
  // $objResponse['success'] = false;
  // $objResponse['code'] = 400;
  // $objResponse['info'] = "沒有任何更新";
  // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  // exit();
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">沒有任何更新</span>
    </button>
  </div>
<?php
}
require_once('../templates/footer.php');
