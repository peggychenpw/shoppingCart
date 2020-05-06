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
$sql = "UPDATE `class` SET 
        `className` = ? ,`classPeopleLimit` = ? ,`classPrice` = ?,`classCategoryId` = ?, `isAlive` = ? ,`classDate` = ?,
        `classTime` = ?
        WHERE `id` = ? ";

$arrParam = [
  $_POST['className'],
  $_POST['classPeopleLimit'],
  $_POST['classPrice'],
  $_POST['classCategoryId'],
  $_POST['classAlive'],
  $_POST['classDate'],
  $_POST['classTime'],
  $_POST['id']
];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if ($stmt->rowCount() > 0) {
  // echo '<script>alert("修改成功")</script>';
  header("Refresh: 1; url=../backStage/shopClassInfo.php?id={$_POST['id']}");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">修改成功</span>
    </button>
  </div>
<?php
} else {
  // echo '<script>alert("修改失敗")</script>';
  header("Refresh: 1; url=../backStage/shopClassInfo.php?id={$_POST['id']}");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">沒有做任何更新!!</span>
    </button>
  </div>
<?php
}
require_once('../templates/footer.php');
