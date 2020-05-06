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
<br>
<a class="btn btn-outline-secondary ml-2" href="./admin.php" role="button">商品列表</a>
<br>
<br>
<h3>新增商品</h3>
<form name="myForm" enctype="multipart/form-data" method="POST" action="../action/add.php">
  <table class="table table-striped table-gray text-center">
    <thead class="thead-light">
      <tr>
        <th class="border">商品名稱</th>
        <th class="border">商品照片路徑</th>
        <th class="border">商品規格</th>
        <th class="border">商品價格</th>
        <th class="border">商品數量</th>
        <th class="border">商品種類</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="border">
          <input class="form-control" type="text" name="itemName" value="" maxlength="100" />
        </td>
        <td class="border">
          <div class="custom-file">
            <input type="file" name="itemImg" class="custom-file-input" id="validatedCustomFile" required>
            <label class="custom-file-label" for="validatedCustomFile"></label>
            <div class="invalid-feedback">Example invalid custom file feedback</div>
          </div>
        </td>
        <td class="border">
          <input class="form-control" type="text" name="itemSize" value="" maxlength="11" />
        </td>
        <td class="border">
          <input class="form-control" type="text" name="itemPrice" value="" maxlength="11" />
        </td>
        <td class="border">
          <input class="form-control" type="text" name="itemQty" value="" maxlength="3" />
        </td>
        <td class="border">
          <select class="custom-select" name="itemCategoryId">
            <?php buildTree($pdo, 0); ?>
          </select>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td class="border text-left" colspan="6"><input class="btn btn-outline-secondary" type="submit" name="smb" value="新增"></td>
      </tr>
    </tfoot>
  </table>
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