<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>
<br>
<a class="btn btn-outline-secondary ml-2" href="./admin.php"role="button">商品列表</a>
<br>
<br>
<h3>多圖設定</h3>

<form name="myForm" method="POST" action="../action/deleteMultipleImages.php">
  <table class="border">
    <thead>
      <tr>
        <th class="border">選擇</th>
        <th class="border">商品編號</th>
        <th class="border">圖片路徑</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT `multipleImageId`, `multipleImageImg`,`itemId`, `created_at`, `updated_at`
            FROM `multiple_images`
            WHERE `itemId` = ?
            ORDER BY `multipleImageId` ASC";
      $stmt = $pdo->prepare($sql);
      $arrParam = [
         $_GET['itemId']
      ];
      $stmt->execute($arrParam);
      if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
      ?>
          <tr>
            <td class="border">
              <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['multipleImageId']; ?>" />
            </td>
            <td class="border">
              <input type="text"  value="<?php echo $arr[$i]['itemId']; ?>" />
            </td>
            <td class="border">
              <img class="previous_images" src="../images/multiple_images/<?php echo $arr[$i]['multipleImageImg'] ?>" width="300px">
            </td>
          </tr>

        <?php
        }
      } else {
        ?>

        <tr>
          <td class="border" colspan="2">尚未上傳圖檔</td>
        </tr>

      <?php
      }
      ?>
  </table>
  <input type="submit" name="smb_delete" value="刪除">
  <input type="hidden" name="itemId" value="<?php echo $_GET['itemId']; ?>">
</form>

<hr />

<form name="myForm" method="POST" action="../action/insertMultipleImages.php" enctype="multipart/form-data">
  <table class="border">
    <thead>
      <tr>
        <th class="border">多圖上傳</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="border">
          <input type="file" name="multipleImageImg[]" value="" multiple />
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td class="border"><input type="submit" name="smb_add" value="新增"></td>
      </tr>
    </tfoot>
  </table>
  <input type="hidden" name="itemId" value="<?php echo $_GET['itemId']; ?>">
</form>

<?php
require_once('../templates/footer.php');
?>