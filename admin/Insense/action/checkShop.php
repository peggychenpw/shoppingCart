<style>
  .loading-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .loading-content {
    border: transparent;
  }
</style>
<?php
session_start(); //啟動 session
require_once('../action/db.inc.php');
require_once('../templates/header.php');

//判斷是否登入 (確認先前指派的 session 索引是否存在)
if (!isset($_SESSION['username'])) {
  //3 秒後跳頁
  header("Refresh: 1; url=../backStage/log.php");
  // echo "<script>請確實登入</script>";
  // exit();
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">請確實登入!!!</span>
    </button>
  </div>
<?php
  exit();
}
?>
<?php
$sql = "SELECT `shop`.`shopId`
        FROM `shop`
        WHERE `shop`.`username` = '{$_SESSION['username']}'";

$stmt = $pdo->query($sql);
if ($stmt->rowCount() == 0) {
  header("Refresh: 1; url=../backStage/log.php");
  // echo "您無權使用該網頁…3秒後自動回登入頁";
  // exit();
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">您無權使用該網頁…</span>
    </button>
  </div>
<?php
  exit();
}
?>