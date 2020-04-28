<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
?>

<?php
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>

    <h3>訂單一覽</h3>
        <form name="myForm" method="POST" action="./checkSearch.php">
            <tr>
                訂單編號 <input type="text" name="search" required>
                <td class="border" colspan="2">
                <button class="btn btn-outline-dark" type="submit" name="smb_add">搜尋</button> 
                </td>
            </tr>
       </form>
       <form name="myForm" method="POST" action="./deleteCheck.php">
                <table class="border table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="border">
                                <div class="py-2 text-uppercase">項目</div>
                            </th>
                            <th scope="col" class="border">
                                <div class="p-2 px-3 text-uppercase">訂單編號</div>
                            </th>
                            <th scope="col" class="border">
                                <div class="py-2 text-uppercase">付款方式</div>
                            </th>
                            <th scope="col" class="border">
                                <div class="py-2 text-uppercase">詳細資訊</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlOrder = "SELECT `orders`.`orderId`,`orders`.`created_at`,`orders`.`updated_at`,`payment_types`.`paymentTypeName`
                                    FROM `orders` INNER JOIN `payment_types`
                                    ON `orders`.`paymentTypeId` = `payment_types`.`paymentTypeId`
                                ORDER BY `orders`.`orderId` DESC";
                        $stmtOrder = $pdo->prepare($sqlOrder);
                        $stmtOrder->execute();
                        if ($stmtOrder->rowCount() > 0) {
                            $arrOrders = $stmtOrder->fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($arrOrders); $i++) {
                        ?>
                                <tr>
                                    <td class="border">
                                        <input type="checkbox" name="chk[]" value="<?php echo $arrOrders[$i]["orderId"]; ?>" class="check" />
                                    </td>
                                    <th scope="row" class="border"><?php echo $arrOrders[$i]["orderId"] ?></th>
                                    <td class="border"><?php echo $arrOrders[$i]["paymentTypeName"] ?></td>
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
                    <td class="border" colspan="2"><button class="btn btn-outline-dark" type="submit" name="smb_add">刪除</button></td>
                </form>
        </div>

        </form>

<?php
require_once('../templates/footer.php');
?>