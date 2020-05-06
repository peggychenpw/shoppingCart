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
session_start();
require_once("./checkSession.php");
require_once('../action/db.inc.php');
require_once('../templates/header.php');

if (!isset($_POST["paymentTypeId"])) {
  header("Refresh: 1; url=./myCart.php");
  // echo "<script type='text/javascript'>alert(`請選擇付款方式！ ><`);</script>";
  // exit();
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">請選擇付款方式</span> </button> </div> <?php
                                                            }

                                                            //先取得訂單編號
                                                            $sqlOrder = "INSERT INTO `orders` (`username`,`paymentTypeId`) VALUES (?,?)";
                                                            $stmtOrder = $pdo->prepare($sqlOrder);
                                                            $arrParamOrder = [
                                                              $_SESSION["username"],
                                                              $_POST["paymentTypeId"]
                                                            ];
                                                            $stmtOrder->execute($arrParamOrder);
                                                            $orderId = $pdo->lastInsertId();

                                                            $count = 0;

                                                            //新增購物車中的每一個項目
                                                            $sqlItemList = "INSERT INTO `item_lists` (`orderId`,`itemId`,`checkPrice`,`checkQty`,`checkSubtotal`) VALUES (?,?,?,?,?)";
                                                            $stmtItemList = $pdo->prepare($sqlItemList);
                                                            for ($i = 0; $i < count($_POST["itemId"]); $i++) {
                                                              $arrParamItemList = [
                                                                $orderId,
                                                                $_POST["itemId"][$i],
                                                                $_POST["itemPrice"][$i],
                                                                $_POST["cartQty"][$i],
                                                                $_POST["subtotal"][$i]
                                                              ];
                                                              $stmtItemList->execute($arrParamItemList);
                                                              $count += $stmtItemList->rowCount();
                                                            }

                                                            if ($count > 0) {
                                                              header("Refresh: 1; url=./order.php");

                                                              //帳號完成後，注銷購物車資訊
                                                              unset($_SESSION["cart"]);

                                                              // $objResponse['success'] = true;
                                                              // $objResponse['code'] = 200;
                                                              // $objResponse['info'] = "訂單新增成功";
                                                              // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                                              // exit();
                                                              ?> <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">訂單新增成功!</span>
    </button>
  </div>
<?php
                                                            } else {
                                                              header("Refresh: 1; url=./order.php");
                                                              // $objResponse['success'] = false;
                                                              // $objResponse['code'] = 400;
                                                              // $objResponse['info'] = "訂單新增失敗";
                                                              // echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                                                              // exit();
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">訂單新增失敗!</span>
    </button>
  </div>
<?php
                                                            }
?>
</div>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>