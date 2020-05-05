<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
?>

<?php
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>

<?php
$count = 0;

if (!isset($_POST['chk'])) {
  header('refresh:0.1;url=./checkSearch.php');  //改成checkSearch.php  popup效果先用alert替代
  echo "<script type='text/javascript'>alert(`你沒選到要取消的訂單呦 >w<`);</script>";
?>

  <!-- <div class="con">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                
                <div class="card-body">
                    <span class="badge badge-warning">Warning</span>
                    <p class="card-text">請先勾選要刪除訂單</p>
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>   
        </div> -->

  <h3 class="pt-3 pb-2 d-flex justify-content-center">訂單管理</h3>

  <form name="myForm" method="POST" action="./checkSearch.php" class="ml-3">
    訂單編號 <input type="text" name="checkSearch" required>


    <tr>
      <td class="border" colspan="2">
        <button class="btn btn-outline-dark" type="submit" name="smb_add">
          搜尋
        </button>
      </td>
    </tr>

  </form>
  <form name="myForm" method="POST" action="./deleteCheck.php">
    <table class="border table table-hover">
      <thead class="thead-light">
        <tr>

          <th scope="col" class="border">
            <div class="py-2 text-uppercase">取消訂單</div>
          </th>

          <th scope="col" class="border">
            <div class="p-2 px-3 text-uppercase">訂單編號</div>
          </th>
          <th scope="col" class="border">
            <div class="py-2 text-uppercase">付款方式</div>
          </th>
          <th scope="col" class="border w-50">
            <div class="py-2 text-uppercase">詳細資訊</div>
          </th>

        </tr>
      </thead>
      <tbody>
        <?php

        $string = $_POST['checkSearch'];

        $sqlOrder = "SELECT `orders`.`orderId`,`orders`.`created_at`,`orders`.`updated_at`,`payment_types`.`paymentTypeName`
                            FROM `orders` INNER JOIN `payment_types`
                            ON `orders`.`paymentTypeId` = `payment_types`.`paymentTypeId`
                             WHERE `orderId` LIKE '%{$string}%'
                            ORDER BY `orders`.`orderId`";
        $stmtOrder = $pdo->prepare($sqlOrder);
        $stmtOrder->execute();
        if ($stmtOrder->rowCount() > 0) {
          $arrOrders = $stmtOrder->fetchAll(PDO::FETCH_ASSOC);
          for ($i = 0; $i < count($arrOrders); $i++) {
        ?>
            <tr>
              <td class="border">
                <input type="checkbox" name="chk[]" class="check" value="<?php echo $arrOrders[$i]["orderId"]; ?>" />
              </td>

              <th scope="row" class="border"><?php echo $arrOrders[$i]["orderId"] ?>
              </th>
              <td class="border"><?php echo $arrOrders[$i]["paymentTypeName"] ?>
              </td>
              <td class="border">

                <?php
                $sqlItemList = "SELECT `item_lists`.`checkPrice`,`item_lists`.`checkQty`,`item_lists`.`checkSubtotal`,
                                        `items`.`itemName`,`categories`.`categoryName`
                                            FROM `item_lists` 
                                            INNER JOIN `items`
                                            ON `item_lists`.`itemId` = `items`.`itemId`
                                            INNER JOIN `categories` 
                                            ON `items`.`itemCategoryId` = `categories`.`categoryId`
                                            WHERE `item_lists`.`orderId` = ? 
                                            ORDER BY `item_lists`.`itemListId` ASC";
                $stmtItemList = $pdo->prepare($sqlItemList);
                $arrParamItemList = [
                  $arrOrders[$i]["orderId"]
                ];
                $stmtItemList->execute($arrParamItemList);
                if ($stmtItemList->rowCount() > 0) {
                  $arrItemList = $stmtItemList->fetchAll(PDO::FETCH_ASSOC);
                  for ($j = 0; $j < count($arrItemList); $j++) {
                ?>
                    <p>商品名稱: <?php echo $arrItemList[$j]["itemName"] ?></p>
                    <p>商品種類: <?php echo $arrItemList[$j]["categoryName"] ?></p>
                    <p>單價: <?php echo $arrItemList[$j]["checkPrice"] ?></p>
                    <p>數量: <?php echo $arrItemList[$j]["checkQty"] ?></p>
                    <p>小計: <?php echo $arrItemList[$j]["checkSubtotal"] ?></p>
                    <br />
                <?php
                  }
                }
                ?>
              </td>

            </tr>
        <?php
          }
        }
        ?>

      </tbody>
    </table>
    <form name="myForm" method="GET" action="./Alldelete.php">

      <td class="border" colspan="2"><button class="btn btn-outline-dark ml-3" type="submit" name="smb_add">取消全部</button>
      </td>
    </form>
    </div>

  </form>

  <script>
    // When the user clicks on <div>, open the popup
    function myFunction() {
      var popup = document.getElementById("cancelPopup");
      popup.classList.toggle("show");
    }
  </script>

<?php
  exit();
}
?>

<?php
require_once('../templates/footer.php');
?>


<?php
for ($i = 0; $i < count($_POST['chk']); $i++) {
  //加入繫結陣列
  $arrParam = [
    $_POST['chk'][$i]
  ];

  // echo "<pre>";
  // print_r($arrParam);
  // echo "</pre>";
  // exit();


  //找出特定 itemId 的資料
  $sqlImg = "SELECT `orderId` FROM `orders` WHERE `orderId` = ? ";
  $stmt_img = $pdo->prepare($sqlImg);
  $stmt_img->execute($arrParam);
  // echo "<pre>";
  // print_r($stmt_img);
  // echo "</pre>";
  // exit();

  //有資料，則進行檔案刪除
  if ($stmt_img->rowCount() > 0) {
    //取得檔案資料 (單筆)
    $arr = $stmt_img->fetchAll();
    // echo "<pre>";
    // print_r($arr);
    // echo "</pre>";
    // exit();

    //刪除檔案
    // $bool = unlink("../images/items/" . $arr[0]['itemImg']);

    //若檔案刪除成功，則刪除資料
    if (isset($arr)) {
      //SQL 語法
      $sql = "DELETE FROM `orders` WHERE `orderId` = ? ";
      $stmt = $pdo->prepare($sql);
      $stmt->execute($arrParam);

      //累計每次刪除的次數
      $count += $stmt->rowCount();
    };
  }
}

if ($count > 0) {
  header("Refresh: 0; url=./orders.php");
  echo "<script type='text/javascript'>alert(`刪除成功 >w<`);</script>";
  exit();
} else {
  header("Refresh: 1; url=./orders.php");
  echo "<script type='text/javascript'>alert(`刪除失敗 >w<`);</script>";
  exit();
}
?>