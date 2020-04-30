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
    echo "<ul>";
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($arr); $i++) {
      echo "<li>";
      echo "<input type='radio' name='categoryId' value='" . $arr[$i]['categoryId'] . "' />";
      echo $arr[$i]['categoryName'];
      echo " | <a href='./editCategory.php?editCategoryId=" . $arr[$i]['categoryId'] . "'>編輯</a>";
      echo " | <a href='../action/deleteCategory.php?deleteCategoryId=" . $arr[$i]['categoryId'] . "'>刪除</a>";
      buildTree($pdo, $arr[$i]['categoryId']);
      echo "</li>";
    }
    echo "</ul>";
  }
}
?>
<?php
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>
<br>
<a class="btn btn-outline-secondary ml-3" href="./admin.php" role="button">商品列表</a>
<br>
<br>
<h3>編輯類別</h3>
<form name="myForm" method="POST" action="../action/insertCategory.php">

  <?php buildTree($pdo, 0); ?>

  <table class="border ml-3">
    <thead>
      <tr>
        <th class="border">類別名稱</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="border">
          <input type="text" name="categoryName" value="" maxlength="100" />
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td class="border"><input type="submit" name="smb" value="新增"></td>
      </tr>
    </tfoot>
  </table>

</form>
<?php
require_once('../templates/footer.php');
?>