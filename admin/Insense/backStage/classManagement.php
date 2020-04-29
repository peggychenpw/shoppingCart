<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer

// search


$sqlTotal = "SELECT COUNT(1) FROM `class` ";
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];
$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total / $numPerPage); // 總頁數
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1


//課程種類 SQL 敘述
$sqlTotalClass = "SELECT count(1) FROM `class` ";

//取得課程種類總筆數
$totalClass = $pdo->query($sqlTotalClass)->fetch(PDO::FETCH_NUM)[0];


//SQL 敘述
$sql = "SELECT `class`.`id`,`class`.`classId`, `class`.`className`, `class`.`classPrice`, `classcategory`.`classCategoryName`, 
`class`.`classPeopleLimit`, `class`.`classDate`, `class`.`classTime`, `class`.`created_at`,
`class`.`updated_at`
FROM `class` INNER JOIN `classcategory`
ON `class`.`classCategoryId` = `classcategory`.`classCategoryId` ";

switch ($_POST['class']) {
  case 'className':
    $sql .= "WHERE `class`.`className` LIKE '%{$_POST['searchName']}%' ";
    $sql .= "ORDER BY `class`.`id` ASC ";
    $classNameCheck = 'checked';
    break;
  case 'classPrice':
    $sql .= "ORDER BY `class`.`classPrice` ";
    if ($_POST['classPriceSequence'] === 'ASC') {
      $sql .= "ASC ";
    } elseif ($_POST['classPriceSequence'] === 'DESC') {
      $sql .= "DESC ";
    }
    $classPriceCheck = 'checked';
    break;
  case 'classCategories':
    $sql .= "WHERE `class`.`classCategoryId` = '{$_POST['classCategory']}' ";
    $sql .= "ORDER BY `class`.`id` ASC ";
    $classCategorySelect = 'selected';
    break;
  case 'classPeopleLimit':
    $sql .= "WHERE `class`.`classPeopleLimit` >= {$_POST['miniPeople']} AND `class`.`classPeopleLimit` <= {$_POST['maxPeople']} ";
    $sql .= "ORDER BY `class`.`id` ASC ";
    $classPeopleLimitCheck = 'checked';
    break;
}

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
<form method="POST" action="classManagement.php">
  <p>搜尋方式：</p>
  <input type="radio" name="class" id="className" value="className">
  <label for="className">名稱:</label>
  <input type="text" name="searchName">
  <br>
  <input type="radio" name="class" id="classPrice" value="classPrice">
  <label for="classPrice">價格:</label>
  <select name="classPriceSequence" id="">
    <option value="DESC">▼</option>
    <option value="ASC">▲</option>
  </select>
  <br>
  <input type="radio" name="class" id="classCategories" value="classCategories">
  <label for="classCategories">課程類別:</label>
  <select name="classCategory" id="">
    <option value="c_perfume">香水體驗</option>
    <option value="c_soap">香皂體驗</option>
  </select>
  <br>
  <input type="radio" name="class" id="classPeopleLimit" value="classPeopleLimit">
  <label for="classPeopleLimit">人數限制:</label>
  <input type="text" name="miniPeople" placeholder="最小值"> -
  <input type="text" name="maxPeople" placeholder="最大值">
  <br>
  <input type="radio" name="class" id="classDate" value="classDate">
  <label for="classDate">日期:</label>
  <div>
    <input type="submit" value="查詢">
  </div>
</form>
<?php
//若有建立商品種類，則顯示商品清單
if ($totalClass > 0) {
?>
  <form method="POST" enctype="multipart/form-data" action="../action/deleteClass.php">
    <table class="table table-striped table-gray text-center">
      <thead class="thead-dark">
        <tr>
          <th class="border">勾選</th>
          <th class="border">課程名稱</th>
          <th class="border">課程價格</th>
          <th class="border">課程類別</th>
          <th class="border">上限人數</th>
          <th class="border">上課日期</th>
          <th class="border">上線時間</th>
          <th class="border">功能</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql .= "LIMIT ?, ? ";
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
  </form>
<?php
} else {
  //引入尚未建立商品種類的文字描述
  require_once('../templates/noCategory.php');
}
require_once('../templates/footer.php'); //引入footer
?>