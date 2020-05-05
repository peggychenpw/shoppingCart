<?php
session_start();
require_once("./checkSession.php");
require_once('../action/db.inc.php');
require_once('./tpl/tpl-html-head.php');
require_once('./tpl/header.php');
require_once("./tpl/func-buildTree.php");
require_once("./tpl/func-getRecursiveCategoryIds.php");
?>

<style>

  .container {
    margin: 0 auto;
  }
</style>

<form name="myForm" method="POST" action="./deleteOrder.php">

  <div class="container">
    <div class="text">
      <h3 class="mt-3 mb-3 ml-4">感謝購買</h3>
      <!-- 樹狀商品種類連結 -->
      <!-- <div class="col-md-2 col-sm-3"><?php buildTree($pdo, 0); ?></div> -->
      <!-- 商品項目清單 -->
      <div class="col-md-12 col-sm-9">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="border-0 bg-light">
                  <div class="p-2 px-3 text-uppercase">訂單編號</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">付款方式</div>
                </th>
                <th scope="col" class="border-0 bg-light w-50">
                  <div class="py-2 text-uppercase">詳細資訊</div>
                </th>
                <!-- <th scope="col" class="border-0 bg-light">
                  <div class="py-2 text-uppercase">功能</div>
                </th>
              </tr> -->
            </thead>
            <tbody>
              <?php
              $sqlOrder = "SELECT `orders`.`orderId`,`orders`.`created_at`,`orders`.`updated_at`, `payment_types`.`paymentTypeName`
                                FROM `orders` INNER JOIN `payment_types`
                                ON `orders`.`paymentTypeId` = `payment_types`.`paymentTypeId`
                                WHERE `orders`.`username` = ? 
                                ORDER BY `orders`.`orderId` DESC";
              $stmtOrder = $pdo->prepare($sqlOrder);
              $arrParamOrder = [
                $_SESSION["username"]
              ];
              $stmtOrder->execute($arrParamOrder);
              if ($stmtOrder->rowCount() > 0) {
                $arrOrders = $stmtOrder->fetchAll(PDO::FETCH_ASSOC);
                // for ($i = 0; $i < count($arrOrders); $i++) {
              ?>
                  <tr>
                    <th scope="row" class="border-0 pl-5 align-middle"><?php echo $arrOrders[0]["orderId"] ?></th>
                    <td class="border-0 align-middle"><?php echo $arrOrders[0]["paymentTypeName"] ?></td>
                    <td class="border-0 align-middle">
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
                        $arrOrders[0]["orderId"]
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
                          <p class="mb-5">小計: <?php echo $arrItemList[$j]["checkSubtotal"] ?></p>
                      <?php
                        }
                      }
                      ?>
                    </td>
                    <!-- <td class="border-0 align-middle"><a href="./deleteOrder.php?orderId=<?php echo $arrOrders[$i]["orderId"] ?>" class="text-dark">刪除</a></td> -->
                  </tr>
              <?php
                // }
              }
              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

</form>

<?php
require_once('./tpl/footer.php');
require_once('./tpl/tpl-html-foot.php');
?>