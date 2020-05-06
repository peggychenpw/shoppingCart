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
require_once('./checkShop.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
$count = 0;
// print_r($_POST);
// exit();
for ($i = 0; $i < count($_POST['chk']); $i++) {
  //加入繫結陣列
  $arrParam = [
    $_POST['chk'][$i]
  ];
  $sql = "DELETE FROM `class` WHERE `id` = ? ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arrParam);

  //累計每次刪除的次數
  $count += $stmt->rowCount();
}
if ($count > 0) {
  // echo '<script>alert("刪除成功")</script>';
  header("Refresh: 1;url=../backStage/shopClassManagement.php?page={$_POST['pageNum']}");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">刪除成功</span>
    </button>
  </div>
<?php
} else {
  // echo '<script>alert("請先勾選再刪除!!!")</script>';
  header("Refresh: 1;url=../backStage/shopClassManagement.php?page={$_POST['pageNum']}");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">請先勾選再刪除!!!</span>
    </button>
  </div>
<?php
}
