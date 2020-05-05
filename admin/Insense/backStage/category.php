<style>
  .labelCategory {
    /* border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0; */
    border-radius: 0 !important;
  }

  .btnCategory {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
  }

  .bgColor {
    background: var(--main-logo-blue);
  }
</style>

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
    echo "<div class='pl-0'>";
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($arr); $i++) {
      echo '<div class="pl-5">';
      echo '<div class="input-group py-2 mx-2">';
      echo '<div class="input-group-prepend ">';
      echo '<div class="input-group-text">';
      echo "<input class='bgColor' type='radio' name='categoryId' id='itemCategory" . $arr[$i]['categoryId'] . "' />";
      echo '</div>';
      echo '</div>';
      echo '<label class="input-group-text labelCategory bgColor" for="itemCategory' . $arr[$i]['categoryId'] . '">' . $arr[$i]['categoryName'] . ":" . '</label>';
      echo "<a class='btn btn-outline-secondary labelCategory' href='./editCategory.php?editCategoryId=" . $arr[$i]['categoryId'] . "'>編輯</a>";
      echo "<a class='btn btn-outline-secondary btnCategory' href='../action/deleteCategory.php?deleteCategoryId=" . $arr[$i]['categoryId'] . "'>刪除</a>";
      echo '</div>';
      buildTree($pdo, $arr[$i]['categoryId']);
      echo "</div>";
    }
    echo "</div>";
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
<!-- <h3>編輯類別</h3> -->
<form name="myForm" method="POST" action="../action/insertCategory.php">

  <?php buildTree($pdo, 0); ?>

  <table class="table table-striped table-gray text-center col-3 ml-5 mt-3">
    <thead class="thead-light">
      <tr>
        <th class="border">類別名稱</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="border">
          <input class="form-control" type="text" name="categoryName" value="" maxlength="100" />
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td class="border"><input class="btn btn-outline-secondary" type="submit" name="smb" value="新增"></td>
      </tr>
    </tfoot>
  </table>

</form>
<?php
require_once('../templates/footer.php');
?>