<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
?>

<a class="home btn btn-outline-secondary ml-3 my-3" href="./adminCoupon.php">我的優惠券</a>
<h3 class="ml-3 pb-2">編輯優惠券</h3>
<form name="myForm" enctype="multipart/form-data" method="POST" action="../action/updateCoupon.php">
  <table class="table table-striped table-gray text-center">
    <thead class="thead-light">
      <tr>
        <th class="border">優惠券名稱</th>
        <th class="border">優惠碼</th>
        <th class="border">優惠券折扣</th>
        <th class="border">起始日期</th>
        <th class="border">結束日期</th>
        <th class="border">新增時間</th>
        <th class="border">更新時間</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //SQL 敘述
      $sql = "SELECT *
                FROM `coupon` 
                WHERE `couponId` = ? ";

      $arrParam = [
        (int) $_GET['couponId']
      ];
      // $_SESSION['couponId'] = (int)$_GET['couponId'];
      //查詢
      $stmt = $pdo->prepare($sql);
      $stmt->execute($arrParam);

      //資料數量大於 0，則列出相關資料
      if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($arr);
        // exit;
      ?>

        <tr>
          <input type="hidden" name="couponId" value="<?php $arr[0]['couponId']; ?>">
          <td class="border">
            <input class="form-control" type="text" name="couponName" value="<?php echo $arr[0]['couponName']; ?>" maxlength="100" />
          </td>
          <td class="border">
            <input class="form-control" type="text" name="couponCode" value="<?php echo $arr[0]['couponCode']; ?>" maxlength="100" />
          </td>
          <td class="border">
            <input class="form-control" type="text" name="couponDiscount" value="<?php echo $arr[0]['couponDiscount']; ?>" maxlength="11" />
          </td>
          <td class="border">
            <input class="form-control" type="date" name="couponStart" value="<?php echo $arr[0]['couponStart']; ?>" maxlength="20" />
          </td>
          <td class="border">
            <input class="form-control" type="date" name="couponEnd" value="<?php echo $arr[0]['couponEnd']; ?>" maxlength="20" />
          </td>
          <td class="border"><?php echo $arr[0]['created_at']; ?></td>
          <td class="border"><?php echo $arr[0]['updated_at']; ?></td>
        </tr>
      <?php
      } else {
      ?>
        <tr>
          <td colspan="7">沒有資料</td>
        </tr>
      <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr class="text-left">
        <td class="border" colspan="7"><input class="btn btn-outline-secondary" type="submit" name="smb" value="更新"></td>
      </tr>
      </tfoo>
  </table>
  <input type="hidden" name="couponId" value="<?php echo $arr[0]['couponId']; ?>">
  <!-- <input type="hidden" name="itemId" value="<?php //echo (int)$_GET['couponId']; 
                                                  ?>"> -->
</form>
<?php
require_once('../templates/footer.php');
?>