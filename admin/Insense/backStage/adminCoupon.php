<?php
//session_start();
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
error_reporting(0);

date_default_timezone_set('Asia/Taipei');
$dateToday =  date("Y-m-d");

//每次剛進入預約查詢，清空SESSION，以利重新查詢
if (!isset($_GET['page'])) {
  $_SESSION['searchMethod'] = "";
  $_SESSION['searchText'] = "";
}

//關鍵字查詢後，可跳頁，並保持查詢方式
if (isset($_POST["searchMethod"])) {
  //驗證有無進去判斷
  // echo "yes";
  $_SESSION['searchMethod'] = $_POST['searchMethod'];
  $_SESSION['searchText'] = $_POST['searchText'];
}

// $sql = "SELECT *  FROM `coupon`";  
$sql = "SELECT *
        FROM `coupon`";

$sqlCoupon = "SELECT`couponId` From`coupon` ";


//驗證SESSION存在
// echo $_SESSION["searchMethod"];
// echo $_SESSION["searchText"];

function getSql($colFirst, $colSec)
{
  $searchSql = "WHERE `$colFirst`.`$colSec` LIKE '%{$_SESSION['searchText']}%'";
  return $searchSql;
}

// echo getSql('book','bookId');
// exit();

//搜尋方式
switch ($_SESSION["searchMethod"]) {
  case "couponName":
    $sql .= getSql('coupon', 'couponName');
    // echo $sql;
    //$sql .= "WHERE `book`.`bookId` LIKE '%{$_SESSION['searchText']}%'";
    $couponNameSelect = "selected";
    break;
  case "couponCode":
    $sql .= "WHERE `coupon`.`couponCode` LIKE '%{$_SESSION["searchText"]}%'";
    $couponCodeSelect = "selected";
    break;
  case "couponDiscount":
    $sql .= "WHERE `coupon`.`couponDiscount` LIKE '%{$_SESSION["searchText"]}%'";
    $couponDiscountSelect = "selected";
    break;
  case "couponStart":
    $sql .= "WHERE `coupon`.`couponStart` LIKE '%{$_SESSION["searchText"]}%'";
    $couponStartSelect = "selected";
    break;
}


// //換頁
// //取得預約總筆數
// $sqlTotal = "SELECT count(1) FROM `coupon`"; //SQL 敘述
// $total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得總筆數
// $numPerPage = 5; //每頁幾筆
// $totalPages = ceil($total / $numPerPage); // 總頁數
// $page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
// $page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1



//商品種類 SQL 敘述
$sqlTotalCatogories = "SELECT count(1) FROM ({$sql}) AS `aaa`";


//取得商品種類總筆數
$totalCatogories = $pdo->query($sqlTotalCatogories)->fetch(PDO::FETCH_NUM)[0];
$numPerPage = 20; //每頁幾筆
$totalPages = ceil($totalCatogories / $numPerPage); // 總頁數
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1

?>
<?php
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
?>

<style>
  ._td {
    vertical-align: middle !important;
  }

  .search_bar {
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
  }

  .search2_bar {
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
  }

  ._checkbox {
    cursor: pointer;
    color: #aaa;
    border-bottom: 1px solid #bbb;
  }

  ._checkbox:hover {
    color: #000;
  }

  .page {
    font-size: 24px;
  }
</style>

<a class="btn btn-outline-secondary ml-2 my-3" href="./createCoupon.php">新增優惠券</a>
<form name="couponSearchForm" entype="multipart/form-data" method="POST" action="adminCoupon.php">
  <div class="form-group ml-2">
    <h5>搜尋方式：</h5>
    <div class="input-group">
      <div class="input-group-prepend">
        <select class="custom-select search-bar" name="searchMethod" id="">
          <option value="couponName" <?php echo $couponNameSelect ?>>優惠券名稱</option>
          <option value="couponCode" <?php echo $couponCodeSelect ?>>優惠碼</option>
          <option value="couponDiscount" <?php echo $couponDiscountSelect ?>>
            優惠券折扣</option>
          <option value="couponStart" <?php echo $couponStartSelect ?>>起始日期</option>
        </select>
      </div>
      <input class="form-control col-3 search_bar" type="text" name="searchText" value="<?php echo $_SESSION['searchText'] ?>">
      <input class="btn btn-outline-secondary search2_bar" type="submit" name="smbSearch" value="搜尋">
    </div>
    <!-- <span>優惠券查詢:</span> -->


  </div>
</form>
<?php

//若有建立商品種類，則顯示商品清單
if ($totalCatogories > 0) {
?>
  <!-- Table 樣板 -->
  <form name="myform2" id="myform2" entype="multipart/form-data" method="POST" action="deleteCoupon.php">
    <table class="table table-striped table-gray text-center">
      <thead class="thead-light">
        <tr>
          <th class="border"><label class="mb-0 _checkbox"><input style="display:none;" type='checkbox' name='Check_ctr' onClick="Check('chk[]')">全選</label></th>
          <th class="border">優惠券名稱</th>
          <th class="border">優惠碼</th>
          <th class="border">優惠券折扣</th>
          <th class="border">起始日期</th>
          <th class="border">結束日期</th>
          <th class="border">新增時間</th>
          <th class="border">更新時間</th>
          <th class="border">編輯</th>
        </tr>
      </thead>
      <tbody>
        <?php
        //SQL 敘述
        // $sql = "SELECT *
        //         FROM `coupon`
        //         ORDER BY `coupon`.`couponId` ASC 
        //         LIMIT ?, ? ";
        // $sqlCoupon = "SELECT`couponId` From`coupon` ";
        //設定繫結值
        $sql .= "ORDER BY `coupon`.`couponId` ASC ";
        $sql .= "LIMIT ?, ? ";
        $arrParam = [($page - 1) * $numPerPage, $numPerPage];

        //查詢分頁後的商品資料
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        $stmtCoupon = $pdo->prepare($sqlCoupon);
        $stmtCoupon->execute();


        if ($stmtCoupon->rowCount() > 0) {
          $arrCoupon = $stmtCoupon->fetchAll(PDO::FETCH_ASSOC);
          for ($i = 0; $i < count($arrCoupon); $i++) {
          }
        }


        //若數量大於 0，則列出商品
        if ($stmt->rowCount() > 0) {
          $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

          for ($i = 0; $i < count($arr); $i++) {
        ?>

            <tr>
              <td class="border _td">
                <input type="checkbox" name="chk[]" id="chk[]" value="<?php echo $arr[$i]['couponId']; ?>" />
              </td>
              <td class="border _td"><?php echo $arr[$i]['couponName']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['couponCode']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['couponDiscount']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['couponStart']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['couponEnd']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['created_at']; ?></td>
              <td class="border _td"><?php echo $arr[$i]['updated_at']; ?></td>
              <td class="border _td">
                <a class="btn btn-outline-secondary" href="./editCoupon.php?couponId=<?php echo $arrCoupon[$i]['couponId']; ?>
              ">優惠券編輯</a>
              </td>
            </tr>

          <?php
          }
        } else {
          ?>
          <tr>
            <td class="border" colspan="9">沒有資料</td>
          </tr>
        <?php
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td class="border text-left" colspan="9">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
              <a class="page p-2" href="?page=<?= $i ?>"><?= $i ?></a>
            <?php } ?>
          </td>
        </tr>

        <tr>
          <td class="border text-left" colspan="9"><input class="btn btn-outline-danger" type="submit" name="smb" value="刪除"></td>
        </tr>


        </tfoo>
    </table>
  </form>
  <script>
    function Check(chk) {
      let chkbox = document.getElementsByName(chk);
      if (document.myform2.Check_ctr.checked == true) {
        for (i = 0; i < chkbox.length; i++) {
          chkbox[i].checked = true;
        }
      } else {
        for (i = 0; i < chkbox.length; i++) {
          chkbox[i].checked = false;
        }

      }
    }
  </script>
<?php
} else {
  //引入尚未建立商品種類的文字描述
  require_once('../templates/noCategoryCoupon.php');
}

require_once('../templates/footer.php');
?>