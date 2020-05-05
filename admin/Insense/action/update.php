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
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();


//回傳狀態
$objResponse = [];

//用在繫結 SQL 用的陣列
$arrParam = [];


//SQL 語法
$sql = "UPDATE `items` SET ";

//itemName SQL 語句和資料繫結
$sql .= "`itemName` = ? ,";
$arrParam[] = $_POST['itemName'];

//先刪除資料夾裡的原始照片檔
if ($_FILES["itemImg"]["error"] === 0) {

  // echo "yes";
  // exit();

  $sqlGetImg = "SELECT `itemImg` FROM `items` WHERE `itemId` = ? ";
  $stmtGetImg = $pdo->prepare($sqlGetImg);

  $arrGetImgParam = [
    $_POST['itemId']
  ];

  // echo $_POST['itemId'];
  // exit();

  $stmtGetImg->execute($arrGetImgParam);


  //若有找到 itemImg 的資料
  if ($stmtGetImg->rowCount() > 0) {
    //取得指定 id 的商品資料 (1筆)
    $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);

    // echo $arrImg[0]['itemImg'];
    // exit();

    //若是 itemImg 裡面不為空值，代表過去有上傳過
    if ($arrImg[0]['itemImg'] !== NULL) {

      // echo "yes";
      // exit();
      //刪除實體檔案
      @unlink("../images/items/" . $arrImg[0]['itemImg'] . ".png");
    }
  }

  //若上傳成功 (有夾帶檔案上傳)，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
  if (!move_uploaded_file($_FILES["itemImg"]["tmp_name"], "../images/items/" . $arrImg[0]['itemImg'] . ".png")) {
    //執行 SQL 語法
    echo "檔案移動失敗";
  }
}

// echo $arrImg[0]['itemImg'];

// $sql .= "`itemImg` = ? , ";
// $arrParam[] = $arrImg[0]['itemImg'];

$sql .= "`itemSize` = ? , ";
$arrParam[] = $_POST['itemSize'];

//itemPrice SQL 語句和資料繫結
$sql .= "`itemPrice` = ? , ";
$arrParam[] = $_POST['itemPrice'];

//itemQty SQL 語句和資料繫結
$sql .= "`itemQty` = ? , ";
$arrParam[] = $_POST['itemQty'];

//itemCategoryId SQL 語句和資料繫結
$sql .= "`itemCategoryId` = ? ";
$arrParam[] = $_POST['itemCategoryId'];

$sql .= "WHERE `itemId` = ? ";
$arrParam[] = $_POST['itemId'];


$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

// print_r($stmt);
// exit();


if ($stmt->rowCount() > 0) {
  header("Refresh: 1; url=../backStage/admin.php");
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">更新成功</span>
    </button>
  </div>
<?php
} else {
  header("Refresh: 1; url=../backStage/admin.php");
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
