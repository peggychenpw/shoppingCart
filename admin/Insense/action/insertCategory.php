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

//若沒填寫商品種類時的行為
if ($_POST['categoryName'] == '') {
  header("Refresh: 1; url=../backStage/category.php");
  // $objResponse['success'] = false;
  // $objResponse['code'] = 400;
  // $objResponse['info'] = "請填寫商品種類";
  // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
  // exit();
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">請填寫商品種類</span>
    </button>
  </div>
<?php
}
?>
<?php
//新增類別
if (isset($_POST['categoryId'])) {
  $sql = "INSERT INTO `categories` (`categoryName`, `categoryParentId`) VALUES (?,?)";
  $stmt = $pdo->prepare($sql);
  $arrParam = [
    $_POST['categoryName'],
    $_POST['categoryId']
  ];
  $stmt->execute($arrParam);
  if ($stmt->rowCount() > 0) {
    header("Refresh: 1; url=../backStage/category.php");
    // $objResponse['success'] = true;
    // $objResponse['code'] = 200;
    // $objResponse['info'] = "新增成功";
    // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
?>
    <div class="loading-icon">
      <button class="d-flex align-items-center loading-content" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span class="mb-1 ml-2">新增成功</span>
      </button>
    </div>
  <?php
  } else {
    header("Refresh: 1; url=../backStage/category.php");
    // $objResponse['success'] = false;
    // $objResponse['code'] = 400;
    // $objResponse['info'] = "新增失敗";
    // // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    // exit();
  ?>
    <div class="loading-icon">
      <button class="d-flex align-items-center loading-content" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span class="mb-1 ml-2">新增失敗</span>
      </button>
    </div>
  <?php
  }
} else {
  $sql = "INSERT INTO `categories` (`categoryName`) VALUES (?)";
  $stmt = $pdo->prepare($sql);
  $arrParam = [$_POST['categoryName']];
  $stmt->execute($arrParam);
  if ($stmt->rowCount() > 0) {
    header("Refresh: 1; url=../backStage/category.php");
    // $objResponse['success'] = true;
    // $objResponse['code'] = 200;
    // $objResponse['info'] = "新增成功";
    // // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    // exit();
  ?>
    <div class="loading-icon">
      <button class="d-flex align-items-center loading-content" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span class="mb-1 ml-2">新增成功</span>
      </button>
    </div>
  <?php
  } else {
    header("Refresh: 1; url=../backStage/category.php");
    // $objResponse['success'] = false;
    // $objResponse['code'] = 400;
    // $objResponse['info'] = "新增失敗";
    // // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    // exit();
  ?>
    <div class="loading-icon">
      <button class="d-flex align-items-center loading-content" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span class="mb-1 ml-2">新增失敗</span>
      </button>
    </div>
<?php
  }
}
require_once('../templates/footer.php');
