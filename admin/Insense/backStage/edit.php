<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

//建立種類列表
function buildTree($pdo, $parentId = 0)
{
  $sql = "SELECT `categoryId`, `categoryName`, `categoryParentId`
            FROM `categories` 
            WHERE `categoryParentId` = ?";
  $stmt = $pdo->prepare($sql);
  $arrParam = [$parentId];
  $stmt->execute($arrParam);
  if ($stmt->rowCount() > 0) {
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($arr); $i++) {
      echo "<option value='" . $arr[$i]['categoryId'] . "'>";
      echo $arr[$i]['categoryName'];
      echo "</option>";
      buildTree($pdo, $arr[$i]['categoryId']);
    }
  }
}
?>
<?php
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>
<style>
  .categoryWidth {
    width: 160px;
  }

  .itemNameWidth {
    width: 200px;
  }
</style>
<br>
<a class="btn btn-outline-secondary ml-3" href="./new.php" role="button">新增商品</a>
<a class="btn btn-outline-secondary ml-2" href="./admin.php" role="button">商品列表</a>
<br>
<br>

<h3>商品列表</h3>
<form name="myForm" enctype="multipart/form-data" method="POST" action="../action/update.php">
  <table class="table table-striped table-gray text-center">
    <thead class="thead-light">
      <tr>
        <th class="border">商品編號</th>
        <th class="border">商品名稱</th>
        <th class="border">商品照片</th>
        <th class="border">商品規格</th>
        <th class="border">商品價格</th>
        <th class="border">商品數量</th>
        <th class="border">商品種類</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //SQL 敘述
      $sql = "SELECT `items`.`itemId`, `items`.`itemName`, `items`.`itemImg`,`items`.`itemSize`, `items`.`itemPrice`, 
                        `items`.`itemQty`, `items`.`itemCategoryId`, `items`.`created_at`, `items`.`updated_at`,
                        `categories`.`categoryId`, `categories`.`categoryName`
                FROM `items` INNER JOIN `categories`
                ON `items`.`itemCategoryId` = `categories`.`categoryId`
                WHERE `itemId` = ? ";

      $arrParam = [
        $_GET['itemId']
      ];

      //查詢
      $stmt = $pdo->prepare($sql);
      $stmt->execute($arrParam);

      //資料數量大於 0，則列出相關資料
      if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
      ?>

        <tr>
          <td class="border">
            <input class="form-control" type="text" name="itemId" value="<?php echo $arr[0]['itemId']; ?>" maxlength="6" />
          </td>
          <td class="border itemNameWidth">
            <input class="form-control" type="text" name="itemName" value="<?php echo $arr[0]['itemName']; ?>" maxlength="100" />
          </td>
          <td class="border">
            <img class="itemImg" src="../images/items/<?php echo $arr[0]['itemImg'] . ".png"; ?>" width="150px" /><br />
            <div class="custom-file mt-2">
              <input type="file" name="itemImg" class="custom-file-input" id="validatedCustomFile">
              <label class="custom-file-label" for="validatedCustomFile"></label>
            </div>
          </td>
          <td class="border">
            <input class="form-control" type="text" name="itemSize" value="<?php echo $arr[0]['itemSize']; ?>" maxlength="7" />
          </td>
          <td class="border">
            <input class="form-control" type="text" name="itemPrice" value="<?php echo $arr[0]['itemPrice']; ?>" maxlength="11" />
          </td>
          <td class="border">
            <input class="form-control" type="text" name="itemQty" value="<?php echo $arr[0]['itemQty']; ?>" maxlength="3" />
          </td>
          <td class="border categoryWidth">
            <select class="custom-select" name="itemCategoryId">
              <option value="<?php echo $arr[0]['categoryId']; ?>"><?php echo $arr[0]['categoryName']; ?></option>
              <?php buildTree($pdo, 0); ?>
            </select>
          </td>
        </tr>
      <?php
      } else {
      ?>
        <tr>
          <td colspan="9">沒有資料</td>
        </tr>
      <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td class="border text-left" colspan="9"><input class="btn btn-outline-secondary" type="submit" name="smb" value="更新"></td>
      </tr>
      </tfoo>
  </table>
  <input type="hidden" name="itemId" value="<?php echo $_GET['itemId']; ?>">
</form>
<?php
require_once('../templates/footer.php');
?>

<script>
  $('#validatedCustomFile').on('change', function() {
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
  })
</script>