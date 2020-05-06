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

$count = 0;
for ($i = 0; $i < count($_POST['chk']); $i++) {
  //加入繫結陣列
  $arrParam = [
    $_POST['chk'][$i]
  ];

  //找出特定 itemId 的資料
  $sqlImg = "SELECT `itemImg` FROM `items` WHERE `itemId` = ? ";
  $stmt_img = $pdo->prepare($sqlImg);
  $stmt_img->execute($arrParam);

  //有資料，則進行檔案刪除
  if ($stmt_img->rowCount() > 0) {
    //取得檔案資料 (單筆)
    $arr = $stmt_img->fetchAll();

    //刪除檔案
    $bool = unlink("../images/items/" . $arr[0]['itemImg'] . ".png");


    //若檔案刪除成功，則刪除資料???????????
    if ($bool === true) {
      //SQL 語法
      $sql = "DELETE FROM `items` WHERE `itemId` = ? ";
      $stmt = $pdo->prepare($sql);
      $stmt->execute($arrParam);

      //累計每次刪除的次數
      $count += $stmt->rowCount();
    };
  }
}
if ($count > 0) {
  header("Refresh: 1; url=../backStage/admin.php");
  // echo '<script>alert("刪除成功")</script>';
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">刪除成功</span>
    </button>
  </div>
<?php
} else {
  header("Refresh: 1; url=../backStage/admin.php");
  // echo '<script>alert("刪除失敗")</script>';
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
