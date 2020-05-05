<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
?>

<?php
$sql = "SELECT *
FROM `coupon` 
WHERE `couponId` = ? ";
?>
<a class="btn btn-outline-secondary my-3 ml-2" class="home" href="./adminCoupon.php">我的優惠券</a>
<h3 class="ml-3 pb-2">新增優惠券</h3>
<form name="myForm" enctype="multipart/form-data" method="POST" action="addCoupon.php">
  <table class="table table-striped table-gray text-center">
    <thead class="thead-light">
      <tr>
        <th class="border">優惠券名稱</th>
        <th class="border">優惠碼</th>
        <th class="border">優惠券折扣</th>
        <th class="border">起始日期</th>
        <th class="border">結束日期</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="border">
          <input class="form-control" type="text" name="couponName" value="" maxlength="100" required />
        </td>
        <td class="border">
          <input class="form-control" type="text" name="couponCode" value="" maxlength="11" required />
        </td>
        <td class="border">
          <input class="form-control" type="text" name="couponDiscount" value="" maxlength="5" required />
        </td>
        <td class="border">
          <input class="form-control" name="couponStart" id="date" type="date" required>
          </input>
        </td>
        <td class="border">
          <input class="form-control" name="couponEnd" id="date" type="date" required>
          </input>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr class="text-left">
        <td class="border" colspan="5"><input class="btn btn-outline-secondary" type="submit" name="smb" value="新增"></td>
      </tr>
    </tfoot>
  </table>
</form>
<?php
require_once('../templates/footer.php'); //引入footer
?>