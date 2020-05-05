<?php
error_reporting(0);

require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

//每次剛進入預約查詢，清空SESSION，以利重新查詢
if (!isset($_GET['page'])) {
  $_SESSION['searchMethod'] = "";
  $_SESSION['searchText'] = "";
  $_SESSION['searchPriceStart'] = 0;
  $_SESSION['searchPriceEnd'] = "";
  $_SESSION['sortMethod'] = "byItemId";
  $_SESSION['searchOrder'] = "forward";
}

//關鍵字查詢後，可跳頁，並保持查詢方式
if (isset($_POST["searchMethod"])) {
  //驗證有無進去判斷
  // echo "yes";
  $_SESSION['searchMethod'] = $_POST['searchMethod'];
  $_SESSION['searchText'] = $_POST['searchText'];
  $_SESSION['searchPriceStart'] = $_POST['searchPriceStart'];
  $_SESSION['searchPriceEnd'] = $_POST['searchPriceEnd'];
  $_SESSION['sortMethod'] = $_POST['sortMethod'];
  $_SESSION['searchOrder'] = $_POST['searchOrder'];
}

$sql = "SELECT `items`.`id`,`items`.`itemId`, `items`.`itemName`, `items`.`itemImg`, `items`.`itemSize`,`items`.`itemPrice`, `items`.`itemQty`, `items`.`itemCategoryId`, `items`.`created_at`, `items`.`updated_at`,`categories`.`categoryName`
        FROM `items` 
        INNER JOIN `categories`
        ON `items`.`itemCategoryId` = `categories`.`categoryId`";

// //驗證SESSION存在
// // echo $_SESSION["searchMethod"];
// // echo $_SESSION["searchText"];

//搜尋方式
switch ($_SESSION["searchMethod"]) {
  case "itemId":
    $sql .= "WHERE `items`.`itemId` LIKE '%{$_SESSION['searchText']}%'";
    $itemIdSelect = "selected";
    break;
  case "itemName":
    $sql .= "WHERE `items`.`itemName` LIKE '%{$_SESSION["searchText"]}%'";
    $itemNameSelect = "selected";
    break;
  case "itemQty":
    $sql .= "WHERE `items`.`itemQty` LIKE '%{$_SESSION["searchText"]}%'";
    $itemQtySelect = "selected";
    break;
}


//搜尋價格區間
if ($_SESSION['searchPriceStart'] !== "") {
  $sql .= "AND `items`.`itemPrice` >= '{$_SESSION['searchPriceStart']}'";
}
if ($_SESSION['searchPriceEnd'] !== "") {
  $sql .= "AND `items`.`itemPrice` <= '{$_SESSION['searchPriceEnd']}'";
}

//排序方式
switch ($_SESSION["sortMethod"]) {
  case "byItemId":
    $sql .= "ORDER BY `items`.`itemId` ";
    $byItemId = 'checked="true"';
    break;
  case "byItemPrice":
    $sql .= "ORDER BY `items`.`itemPrice` ";
    $byItemPrice = 'checked="true"';
    break;
  case "byItemQty":
    $sql .= "ORDER BY `items`.`itemQty` ";
    $byItemQty = 'checked="true"';
    break;
  case "byCategoryName":
    $sql .= "ORDER BY `categories`.`categoryName` ";
    $byCategoryName = 'checked="true"';
    break;
}

//順向或逆向
switch ($_SESSION["searchOrder"]) {
  case "forward":
    $sql .= " ASC ";
    $forwardSelect = "selected";
    break;
  case "backward":
    $sql .= " DESC ";
    $backwardSelect = "selected";
    break;
}

//換頁
//取得預約總筆數
$sqlTotal = "SELECT count(1) FROM ({$sql}) AS `Sublist`"; //SQL 敘述
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得預約總筆數

// echo "<pre>";
// print_r($total);
// echo "</pre>";
// exit();

$numPerPage = 10; //每頁幾筆
$totalPages = ceil($total / $numPerPage); // 總頁數

//第幾頁
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1
$page = $page > $totalPages ? $totalPages : $page; //若 page 大於 總頁數，則回傳 總頁數


//商品種類 SQL 敘述
$sqlTotalCatogories = "SELECT count(1) FROM `categories`";

//取得商品種類總筆數
$totalCatogories = $pdo->query($sqlTotalCatogories)->fetch(PDO::FETCH_NUM)[0];
?>
<?php
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
?>

<style>
  .search-again {
    color: lightslategray;
    border-bottom: dashed gray 1px;
  }

  .search-bar {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  h3 {
    padding: 1vw 2vw;
  }

  .page_num {
    font-size: 32px;
    color: #6c6c6d;
    margin: 8px;
  }

  ._td {
    vertical-align: middle !important;
  }

  .itemName {
    width: 240px;
  }

  .search-form {
    background: #f7f7f7;
  }

  .priceHeight {
    height: 30px;
  }

  .time-flex {
    align-items: center;
  }

  .time-select {
    width: 136px;
  }

  .search-order {
    width: 120px;
    height: 32px;
  }

  div .search-order {
    width: 72px;
  }

  .search-order select {
    width: 20px;
    height: 32px;
    font-size: 16px;
    padding: 0 0 0 10px;
    background: #f9f9f9;
  }

  .page {
    font-size: 24px;
  }
</style>
<div class="d-flex mt-3">
  <div>
    <a class="btn btn-outline-secondary ml-4 mt-2" href="./new.php" role="button">新增商品</a>
    <a class="btn btn-outline-secondary ml-2 mt-2" href="./category.php" role="button">編輯類別</a>
  </div>
  <div class="mb-3">
    <a class="btn btn-outline-secondary ml-2 mt-2 mb-1 " type="button" data-toggle="collapse" data-target="#searchDivDetail" aria-expanded="false" aria-controls="searchDivDetail">
      商品搜尋
    </a>
    <div class="collapse" id="searchDivDetail">
      <form class="mx-3 p-3 search-form" name="itemSearchForm" entype="multipart/form-data" method="POST" action="./admin.php">
        <div class="form-group">
          <h5 class="ml-2 mb-2">搜尋方式</h5>
          <div class="input-group">
            <div class="input-group-prepend ">
              <select class="custom-select search-bar" name="searchMethod" id="">
                <option value="itemId" <?php echo $itemIdSelect ?>>商品編號</option>
                <option value="itemName" <?php echo $itemNameSelect ?>>商品名稱</option>
                <option value="itemQty" <?php echo $itemQtySelect ?>>商品數量</option>
              </select>
            </div>
            <input class="form-control" type="text" name="searchText" value="<?php echo $_SESSION['searchText'] ?>">
          </div>
        </div>

        <div>
          <h5 class="ml-2 mb-2">價格區間</h5>
          <div class="d-flex">
            <input class="form-control mx-2 col-4 priceHeight" id="priceStart" type="text" name="searchPriceStart" value="<?php echo $_SESSION['searchPriceStart'] ?>"> -
            <input class="form-control mx-2 col-4 priceHeight" id="priceEnd" type="text" name="searchPriceEnd" value="<?php echo $_SESSION['searchPriceEnd'] ?>">
          </div>
        </div>
        <!-- 搜尋功能 -->
        <div class="form-group mt-3">
          <h5 class="ml-2 mb-2">排序方式</h5>
          <div class="d-flex row time-flex">
            <label class="input-group time-select ml-3 mb-2" for="byItemId">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="radio" id="byItemId" name="sortMethod" value="byItemId" <?php echo $byItemId ?>>
                </div>
              </div>
              <div class="time-text input-group-text">商品編號</div>
            </label>
            <label class="input-group time-select ml-3 mb-2" for="byItemPrice">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="radio" id="byItemPrice" name="sortMethod" value="byItemPrice" <?php echo $byItemId ?>>
                </div>
              </div>
              <div class="time-text input-group-text">商品價格</div>
            </label>
            <label class="input-group time-select ml-3 mb-2" for="byItemQty">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="radio" id="byItemQty" name="sortMethod" value="byItemQty" <?php echo $byItemId ?>>
                </div>
              </div>
              <div class="time-text input-group-text">商品數量</div>
            </label>
            <label class="input-group time-select ml-3 mb-2" for="byCategoryName">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="radio" id="byCategoryName" name="sortMethod" value="byCategoryName" <?php echo $byItemId ?>>
                </div>
              </div>
              <div class="time-text input-group-text">商品種類</div>
            </label>
            <div class="input-group search-order ml-3 mb-2">
              <select class="custom-select" name="searchOrder" id="">
                <option value="forward" <?php echo $forwardSelect ?>>小至大</option>
                <option value="backward" <?php echo $backwardSelect ?>>大至小</option>
              </select>
            </div>
          </div>
        </div>

        <input class="btn btn-outline-info" type="submit" name="smbSearch" class="ml-4 mr-3">
        <a class="btn btn-outline-secondary ml-2" href="admin.php" class="search-again">重新搜尋</a>
      </form>
    </div>
  </div>
</div>
<?php
//若有建立商品種類，則顯示商品清單
if ($totalCatogories > 0) {
?>
  <!-- Table 樣板 -->
  <form name="myForm mt-" entype="multipart/form-data" method="POST" action="../action/delete.php">
    <table class="table text-center">
      <thead class="thead-light">
        <tr>
          <th class="border">勾選</th>
          <th class="border">商品編號</th>
          <th class="border">商品名稱</th>
          <th class="border">商品照片路徑</th>
          <th class="border">商品規格</th>
          <th class="border">商品價格</th>
          <th class="border">商品數量</th>
          <th class="border">商品種類</th>
          <!-- <th class="border">新增時間</th> -->
          <!-- <th class="border">更新時間</th> -->
          <th class="border">功能</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //SQL 敘述
        $sql .= "LIMIT ?, ? ";

        //設定繫結值
        $arrParam = [($page - 1) * $numPerPage, $numPerPage];

        // echo $sql;
        // print_r ($arrParam);

        //查詢分頁後的商品資料
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);

        //若數量大於 0，則列出商品
        if ($stmt->rowCount() > 0) {
          $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
          for ($i = 0; $i < count($arr); $i++) {
        ?>
            <tr>
              <td class="border _td">
                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['itemId']; ?>" />
              </td>
              <td class="border _td"><?php echo $arr[$i]['itemId']; ?></td>
              <td class="border _td itemName"><?php echo $arr[$i]['itemName']; ?></td>
              <td class="border _td"><img class="itemImg" src="../images/items/<?php echo $arr[$i]['itemImg'] . '.png'; ?>" width="150px" /></td>
              <td class="border _td"><?php echo $arr[$i]['itemSize']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['itemPrice']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['itemQty']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['categoryName']; ?></td>
              <!-- <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
                <td class="border"><?php echo $arr[$i]['updated_at']; ?></td> -->
              <td class="border _td">
                <a class="btn btn-outline-secondary mr-2" href="./edit.php?itemId=<?php echo $arr[$i]['itemId']; ?>">商品編輯</a>
                <!-- <a class="btn btn-outline-secondary" href="./multipleImages.php?itemId=<?php echo $arr[$i]['itemId']; ?>">多圖設定</a> -->
              </td>
            </tr>
          <?php
          }
        } else {
          ?>
          <tr>
            <td class="border" colspan="10">沒有資料</td>
          </tr>
        <?php
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td class="border text-left" colspan="10">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
              <a class="page mr-2" href="?page=<?= $i ?>" class="page_num"><?= $i ?></a>
            <?php } ?>
          </td>
        </tr>

        <?php if ($total > 0) { ?>
          <tr>
            <td class="border text-left" colspan="10"><input type="submit" name="smb" value="刪除" class="btn btn-outline-danger"></td>
          </tr>
        <?php } ?>

      </tfoot>
    </table>
  </form>
<?php
} else {
  //引入尚未建立商品種類的文字描述
  require_once('../templates/noCategory.php');
}
require_once('../templates/footer.php');
?>