<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線


$sqlTotal = "SELECT count(1) FROM `coupon`"; //SQL 敘述
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得總筆數
$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total / $numPerPage); // 總頁數
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1



//商品種類 SQL 敘述
$sqlTotalCatogories = "SELECT count(1) FROM `coupon`";

//取得商品種類總筆數
$totalCatogories = $pdo->query($sqlTotalCatogories)->fetch(PDO::FETCH_NUM)[0];
?>
<?php
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
?>
<h3>我的優惠券</h3>
<a href="./createCoupon.php">新增優惠券</a>
<hr/>
<?php
//若有建立商品種類，則顯示商品清單
if ($totalCatogories > 0) {
?>
  <!-- Table 樣板 -->
  <form name="myForm" entype="multipart/form-data" method="POST" action="deleteCoupon.php">
    <table class="table table-striped table-gray">
      <thead class="thead-dark">
        <tr>
          <th class="border">勾選</th>
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
        $sql = "SELECT *
                FROM `coupon`
                ORDER BY `coupon`.`couponId` ASC 
                LIMIT ?, ? ";
        $sqlCoupon = "SELECT`couponId` From`coupon` ";
        //設定繫結值
        $arrParam = [($page - 1) * $numPerPage, $numPerPage];

        //查詢分頁後的商品資料
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        $stmtCoupon = $pdo->prepare( $sqlCoupon);
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
              <td class="border">
                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['couponId']; ?>" />
              </td>
              <td class="border"><?php echo $arr[$i]['couponName']; ?></td>
              <td class="border"><?php echo $arr[$i]['couponCode']; ?></td>
              <td class="border"><?php echo $arr[$i]['couponDiscount']; ?></td>
              <td class="border"><?php echo $arr[$i]['couponStart']; ?></td>
              <td class="border"><?php echo $arr[$i]['couponEnd']; ?></td>
              <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
              <td class="border"><?php echo $arr[$i]['updated_at']; ?></td>
              <td class="border">
              <a href="./editCoupon.php?couponId=<?php  echo $arrCoupon[$i]['couponId']; ?>
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
          <td class="border" colspan="9">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
              <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php } ?>
          </td>
        </tr>

        <?php if ($total > 0) { ?>
          <tr>
            <td class="border" colspan="9"><input type="submit" name="smb" value="刪除"></td>
          </tr>
        <?php } ?>

        </tfoo>
    </table>
  </form>
<?php
} else {
  //引入尚未建立商品種類的文字描述
  require_once('../templates/noCategory.php');
}
require_once('../templates/footer.php');
?>