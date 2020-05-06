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
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
error_reporting(0);

$count = 0;
for ($i = 0; $i < count($_POST['chk']); $i++) {
  //加入繫結陣列
  $arrParam = [
    $_POST['chk'][$i]
  ];

  //SQL 語法
  $sql = "DELETE FROM `coupon` WHERE `couponId` = ? ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arrParam);

  //累計每次刪除的次數
  $count += $stmt->rowCount();
}
// }
if ($count > 0) {
  header("Refresh: 1; url=../backStage/adminCoupon.php");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">刪除成功</span>
    </button>
  </div>
<?php
} else {
  header("Refresh: 1; url=../backStage/adminCoupon.php");
  // echo "<script type='text/javascript'>alert(`刪除失敗`);</script>";
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">刪除失敗</span>
    </button>
  </div>
<?php
}
require_once('../templates/footer.php');
