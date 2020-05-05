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
$sql = "INSERT INTO `class` ( `className`,`classPrice`,`classPeopleLimit`,
                             `classCategoryId`,`classDate`,`classTime`,`shopId`,`isAlive`) 
        VALUES (?,?,?,?,?,?,?,?)";
$openClass = '開課';

$arrParam = [
  $_POST['className'],
  $_POST['classPrice'],
  $_POST['classPeopleLimit'],
  $_POST['classCategory'],
  $_POST['classDate'],
  $_POST['classTime'],
  $_POST['shopId'],
  $openClass
];
// $lastIdQuery = "SELECT `id` FROM `class` ORDER BY `id` DESC LIMIT 1 ";
// $result = $pdo->prepare($sql);
// $result->execute();
// $row = $result->fetchAll(PDO::FETCH_ASSOC)[0]['id'];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

$classCode = sprintf("C_%d", $pdo->lastInsertId());
$sqlItemCode = "UPDATE `class`
SET `classId` = '{$classCode}'
WHERE `id` = '{$pdo->lastInsertId()}' ";

$stmt = $pdo->prepare($sqlItemCode);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  // echo '<script>alert("新增成功")</script>';
  header("Refresh: 1; url=../backStage/shopClassManagement.php");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">新增成功</span>
    </button>
  </div>
<?php
} else {
  // echo '<script>alert("新增失敗")</script>';
  header("Refresh: 1; url=../backStage/editShopClass.php");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">新增失敗</span>
    </button>
  </div>
<?php
}
require_once('../templates/footer.php');
