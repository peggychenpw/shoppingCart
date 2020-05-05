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
$objResponse = [];

//用在繫結 SQL 用的陣列
$arrParam = [];


//SQL 語法
$sql = "UPDATE `coupon` SET ";

//itemName SQL 語句和資料繫結
$sql .= "`couponName` = ? ,";
$arrParam[] = $_POST['couponName'];


//itemQty SQL 語句和資料繫結
$sql .= "`couponCode` = ? , ";
$arrParam[] = $_POST['couponCode'];

//itemCategoryId SQL 語句和資料繫結
$sql .= "`couponDiscount` = ? , ";
$arrParam[] = $_POST['couponDiscount'];

$sql .= "`couponStart` = ? ,";
$arrParam[] = $_POST['couponStart'];

$sql .= "`couponEnd` = ? ";
$arrParam[] = $_POST['couponEnd'];

$sql .= "WHERE`couponId`= ? ";
$arrParam[] = $_POST['couponId'];


$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
  header("Refresh: 1; url=../backStage/adminCoupon.php?couponId={$_POST['couponId']}");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">更新成功</span>
    </button>
  </div>
<?php
} else {
  header("Refresh: 1; url=../backStage/editCoupon.php?couponId={$_POST['couponId']}");
  // echo "<script type='text/javascript'>alert(`沒有任何更新`);</script>";
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
