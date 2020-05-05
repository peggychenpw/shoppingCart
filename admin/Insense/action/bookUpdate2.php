<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

//回傳狀態
$objResponse = [];

//用在繫結 SQL 用的陣列
$arrParam = [];

//尋找該預約原訂人數及狀態
$sqlFindBook = "SELECT `bookStatus`, `bookQty`
                FROM `book`
                WHERE `bookId` = '{$_GET['bookId']}'";

// echo $sqlFindBook;
// exit();

$stmtFindBook = $pdo->query($sqlFindBook);
$arrFindBook = $stmtFindBook->fetchAll(PDO::FETCH_ASSOC)[0];

$currentBookStatus = $arrFindBook['bookStatus'];
$currentBookQty = $arrFindBook['bookQty'];

// echo "<pre>";
// print_r($arrFindBook);
// echo "</pre>";
// exit();

//找課程價格及人數限制
$sqlFindClass = "SELECT `classPeopleLimit`
                   FROM `class`
                   WHERE `classId` = ? ";

$arrFindClass = [
  $_GET['classId']
];

$stmtFindclass = $pdo->prepare($sqlFindClass);
$stmtFindclass->execute($arrFindClass);

$arrFindClass = $stmtFindclass->fetchAll(PDO::FETCH_ASSOC)[0];

$classPeopleLimit = $arrFindClass['classPeopleLimit'];

// print_r($classPeopleLimit);
// exit();

//找目前上課人數
$sqlFindPeople = "SELECT `bookQty`
     FROM `book`
     WHERE `classId` = '{$_GET['classId']}'
     AND `bookStatus` = '成功'";

$stmtFindPeople = $pdo->query($sqlFindPeople);
$arrFindPeople = $stmtFindPeople->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($arrFindPeople); $i++) {
  $currentPeople += $arrFindPeople[$i]['bookQty'];
}

//找目前除了自己以外的上課人數
if ($currentBookStatus === "成功") {
  $currentOtherPeople = $currentPeople - $currentBookQty;
} else if ($currentBookStatus === "取消") {
  $currentOtherPeople = $currentPeople;
}
//SQL 語法
$sql = "UPDATE `book` SET ";

//bookStatus SQL 語句和資料繫結
$sql .= "`bookStatus` = ? ,";
$arrParam[] = $_POST['bookStatusSelect'];

//bookQty SQL 語句和資料繫結
$sql .= "`bookQty` = ? ";
$arrParam[] = $_POST['bookQtyChange'];

$sql .= "WHERE `bookId` = ? ";
$arrParam[] = $_GET['bookId'];

// echo $sql;
// print_r($arrParam);
// exit();

?>

<?php
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>

<style>
  .loading-icon{
    position: absolute;
    top:50%;
    left: calc( 50% + 7.5vw );
    transform: translate(-50%,-50%);
  }
</style>
<?php

if ($_POST['bookStatusSelect'] === "取消") {
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arrParam);

  if ($stmt->rowCount() > 0) {
    header("Refresh: 1; url=../backStage/bookSearch2.php?page={$_GET['page']}");
    $objResponse['success'] = true;
    $objResponse['code'] = 204;
    $objResponse['info'] = "更新成功";
    // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
?>
    <div class="d-flex justify-content-center loading-icon">
      <div class="spinner-grow text-secondary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <script>
      setTimeout(() => {
        alert("更新成功")
      }, 200);
    </script>

    <?php
    // exit();
  } else {
    header("Refresh: 1; url=../backStage/bookSearch2.php?page={$_GET['page']}");
    $objResponse['success'] = false;
    $objResponse['code'] = 400;
    $objResponse['info'] = "沒有任何更新";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    // exit();
  }
} else {
  if ($_POST['bookQtyChange'] + $currentOtherPeople <= $classPeopleLimit && $_POST['bookQtyChange'] > 0) {

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    if ($stmt->rowCount() > 0) {
      header("Refresh: 1; url=../backStage/bookSearch2.php?page={$_GET['page']}");
      $objResponse['success'] = true;
      $objResponse['code'] = 204;
      $objResponse['info'] = "更新成功";
      // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    ?>
      <div class="d-flex justify-content-center loading-icon">
        <div class="spinner-grow text-secondary" style="width: 3rem; height: 3rem;" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <script>
        setTimeout(() => {
          alert("更新成功")
        }, 200);
      </script>
    <?php
      // exit();
    } else {
      header("Refresh: 1; url=../backStage/bookSearch2.php?page={$_GET['page']}");
      $objResponse['success'] = false;
      $objResponse['code'] = 400;
      $objResponse['info'] = "沒有任何更新";
      echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
      // exit();
    }
  } else {
    $spaceLeft = $classPeopleLimit - $currentOtherPeople
    ?>
    <script>
      setTimeout(() => {

        alert("報名人數超過課程上限，目前最多僅可預約" + <?php echo $spaceLeft ?> + "個名額")
      }, 100);
    </script>
<?php
    header("Refresh: 1; url=../backStage/bookSearch2.php?page={$_GET['page']}");
    $objResponse['success'] = false;
    $objResponse['code'] = 400;
    $objResponse['info'] = "沒有任何更新";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    exit();
  }
}
?>
<?php
require_once('../templates/footer.php');
?>