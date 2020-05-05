<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線

// echo $_GET['page'];
// exit();
$count = 0;
for ($i = 0; $i < count($_POST['chk']); $i++) {
  //加入繫結陣列
  $arrParam = [
    $_POST['chk'][$i]
  ];
  // print_r($arrParam);

  //SQL 語法
  $sql = "DELETE FROM `book` WHERE `bookId` = ? ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arrParam);
  $count += $stmt->rowCount();
}
// exit();
require_once('../templates/header.php');
require_once('../templates/shopLeftSideBar.php');
require_once('../templates/rightContainer.php');
?>

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

//累計每次刪除的次數
if ($count > 0) {
  header("Refresh: 1; url=../backStage/shopBookSearch.php?page={$_GET['page']}");
  $objResponse['success'] = true;
  $objResponse['code'] = 200;
  $objResponse['info'] = "刪除成功";
  // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
?>
  <div class="loading-icon">
    <button class="btn btn-outline-secondary d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">刪除成功</span>
    </button>
  </div>
<?php
  // exit();
} else {
  header("Refresh: 1; url=../backStage/shopBookSearch.php?page={$_GET['page']}");
  $objResponse['success'] = false;
  $objResponse['code'] = 500;
  $objResponse['info'] = "刪除失敗";
  // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
?>
  <div class="loading-icon">
    <button class="btn btn-outline-secondary d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">沒有任何刪除</span>
    </button>
  </div>
<?php
  // exit();
}

require_once('../templates/footer.php');
