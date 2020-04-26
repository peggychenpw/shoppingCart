<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('./db.inc.php'); //引用資料庫連線
require_once('./templates/header.php'); //  1.引入header
require_once('./templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('./templates/rightContainer.php'); // 3. 引入rightContainer


$sqlTotal = "SELECT COUNT(1) FROM `class` ";
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];
$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total / $numPerPage); // 總頁數
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1


//課程種類 SQL 敘述
$sqlTotalClassCatogories = "SELECT count(1) FROM `classcategory` ";

//取得課程種類總筆數
$totalClassCatogories = $pdo->query($sqlTotalClassCatogories)->fetch(PDO::FETCH_NUM)[0];
?>

<!-- #################### content #################### -->
<style>
  /* class zone */

  .classTd {
    position: relative;
  }

  .classTd input[type="checkbox"] {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }
</style>
<?php
//若有建立商品種類，則顯示商品清單
if ($totalClassCatogories > 0) {
?>
  <table class="table table-striped table-gray text-center">
    <thead class="thead-dark">
      <tr>
        <th class="border">勾選</th>
        <th class="border">課程名稱</th>
        <th class="border">課程價格</th>
        <th class="border">課程類別</th>
        <th class="border">上線人數</th>
        <th class="border">上課日期</th>
        <th class="border">上線時間</th>
        <th class="border">功能</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //SQL 敘述
      $sql = "SELECT `class`.`id`,`class`.`classId`, `class`.`className`, `class`.`classPrice`, `classcategory`.`classCategoryName`, 
                        `class`.`classPeopleLimit`, `class`.`classDate`, `class`.`classTime`, `class`.`created_at`,
                        `class`.`updated_at`
                FROM `class` INNER JOIN `classcategory`
                ON `class`.`classCategoryId` = `classcategory`.`classCategoryId`
                ORDER BY `class`.`id` ASC 
                LIMIT ?, ? ";

      //設定繫結值
      $arrParam = [($page - 1) * $numPerPage, $numPerPage];

      //查詢分頁後的商品資料
      $stmt = $pdo->prepare($sql);
      $stmt->execute($arrParam);

      //若數量大於 0，則列出商品
      if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($arr); $i++) {
      ?>
          <tr>
            <td class="border classTd">
              <input type="hidden" name="" value="<?php echo count($arr) ?>">
              <input id='test<?php echo $i ?>' type="checkbox" name="chk[]" value="<?php echo $arr[$i]['id']; ?>" />
            </td>
            <td class="border input<?php echo $i ?>"><?php echo $arr[$i]['className']; ?></td>
            <td class="border input<?php echo $i ?>"><?php echo $arr[$i]['classPrice']; ?></td>
            <td class="border input<?php echo $i ?>"><?php echo $arr[$i]['classCategoryName']; ?></td>
            <td class="border input<?php echo $i ?>"><?php echo $arr[$i]['classPeopleLimit']; ?></td>
            <td class="border input<?php echo $i ?>"><?php echo $arr[$i]['classDate']; ?></td>
            <td class="border input<?php echo $i ?>"><?php echo $arr[$i]['classTime']; ?></td>
            <td class="border">
              <a class="_btn" href="./classInfo.php?id=<?php echo $arr[$i]['id'] ?>">詳細資訊</a> |
              <a href="./comments.php?itemId=<?php echo $arr[$i]['itemId']; ?>">回覆評論</a>
            </td>
          </tr>
        <?php
        }
      } else {
        ?>
        <tr>
          <td class="border" colspan="8">沒有資料</td>
        </tr>
      <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td class="border" colspan="8">
          <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="?page=<?= $i ?>"><?= $i ?></a>
          <?php } ?>
        </td>
      </tr>

      <?php if ($total > 0) { ?>
        <tr>
          <td class="border" colspan="8"><input type="submit" name="smb" value="刪除"></td>
        </tr>
      <?php } ?>

    </tfoot>
  </table>
<?php
} else {
  //引入尚未建立商品種類的文字描述
  require_once('./templates/noCategory.php');
}
require_once('./templates/footer.php'); //引入footer
?>