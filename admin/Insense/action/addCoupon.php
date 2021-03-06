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
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

//回傳狀態
//SQL 敘述
$sql = "INSERT INTO `coupon` (`couponName`,`couponCode`, `couponDiscount`, `couponStart`, `couponEnd`) 
        VALUES (?, ?, ?, ?, ?)";

// print_r($_POST);
// exit();
//繫結用陣列
$arrParam = [
  $_POST['couponName'],
  $_POST['couponCode'],
  $_POST['couponDiscount'],
  $_POST['couponStart'],
  $_POST['couponEnd']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);


if ($stmt->rowCount() > 0) {
  header("Refresh: 1; url=../backStage/adminCoupon.php");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">新增成功</span>
    </button>
  </div>
<?php
} else {
  header("Refresh: 1; url=../backStage/createCoupon.php");
  // echo "<script type='text/javascript'>alert(`沒有新增資料`);</script>";
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
