<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
error_reporting(0);

// search

// 到了首頁清空SESSION
if (!isset($_GET['page'])) {
  $_SESSION['class'] = "";
  $_SESSION['searchName'] = "";
  $_SESSION['miniPrice'] = "";
  $_SESSION['maxPrice'] = "";
  $_SESSION['classCategory'] = "";
  $_SESSION['classPeopleLimitSequence'] = "";
  $_SESSION['classDate'] = "";
}

// 如果class存在則存在SESSION並判斷class值等於多少,來決定存誰的SESSION
if ($_POST['class']) {
  $_SESSION['class'] = $_POST['class'];
  if ($_SESSION['class'] === 'className') {
    $_SESSION['searchName'] = $_POST['searchName'];
    $_SESSION['miniPrice'] = "";
    $_SESSION['maxPrice'] = "";
    $_SESSION['classCategory'] = "";
    $_SESSION['classPeopleLimitSequence'] = "";
    $_SESSION['classDate'] = "";
  } elseif ($_SESSION['class'] === 'classPrice') {
    if (isset($_POST['miniPrice']) && isset($_POST['maxPrice'])) {
      $_SESSION['miniPrice'] = $_POST['miniPrice'];
      $_SESSION['maxPrice'] = $_POST['maxPrice'];
    }
    $_SESSION['searchName'] = "";
    $_SESSION['classCategory'] = "";
    $_SESSION['classPeopleLimitSequence'] = "";
    $_SESSION['classDate'] = "";
  } elseif ($_SESSION['class'] === 'classCategories') {
    $_SESSION['classCategory'] = $_POST['classCategory'];
    $_SESSION['searchName'] = "";
    $_SESSION['miniPrice'] = "";
    $_SESSION['maxPrice'] = "";
    $_SESSION['classPeopleLimitSequence'] = "";
    $_SESSION['classDate'] = "";
  } elseif ($_SESSION['class'] === 'classPeopleLimit') {
    $_SESSION['classPeopleLimitSequence'] = $_POST['classPeopleLimitSequence'];
    $_SESSION['searchName'] = "";
    $_SESSION['miniPrice'] = "";
    $_SESSION['maxPrice'] = "";
    $_SESSION['classCategory'] = "";
    $_SESSION['classDate'] = "";
  } elseif ($_SESSION['class'] === 'classDate') {
    $_SESSION['classDate'] = $_POST['classDate'];
    $_SESSION['searchName'] = "";
    $_SESSION['miniPrice'] = "";
    $_SESSION['maxPrice'] = "";
    $_SESSION['classCategory'] = "";
    $_SESSION['classPeopleLimitSequence'] = "";
  }
} else {
}

//SQL 敘述
$sql = "SELECT `class`.`id`,`class`.`classId`, `class`.`className`, `class`.`classPrice`, `classcategory`.`classCategoryName`, 
`class`.`classPeopleLimit`, `class`.`classDate`, `class`.`classTime`,`class`.`isAlive`, `class`.`created_at`,
`class`.`updated_at`
FROM `class` INNER JOIN `classcategory`
ON `class`.`classCategoryId` = `classcategory`.`classCategoryId` ";
// WHERE `class`.`isAlive` = '上架' 



switch ($_SESSION['class']) {
  case 'className':
    $sql .= "WHERE `class`.`className` LIKE '%{$_SESSION['searchName']}%' ";
    $sql .= "ORDER BY `class`.`id` ASC ";
    $classNameCheck = 'checked';
    break;
  case 'classPrice':
    if (isset($_SESSION['miniPrice']) && $_SESSION['maxPrice'] === "") {
      $sql .= "WHERE `class`.`classPrice` >= {$_SESSION['miniPrice']} ";
    } elseif (isset($_SESSION['maxPrice']) && $_SESSION['miniPrice'] === "") {
      $sql .= "WHERE `class`.`classPrice` <= {$_SESSION['maxPrice']} ";
    } elseif (isset($_SESSION['maxPrice']) && isset($_SESSION['miniPrice'])) {
      $sql .= "WHERE `class`.`classPrice` >= {$_SESSION['miniPrice']} AND `class`.`classPrice` <= {$_SESSION['maxPrice']} ";
    }
    $sql .= "ORDER BY `class`.`classPrice` ASC ";
    $classPriceCheck = 'checked';
    break;
  case 'classCategories':
    $sql .= "WHERE `class`.`classCategoryId` = '{$_SESSION['classCategory']}' ";
    $sql .= "ORDER BY `class`.`id` ASC ";
    $classCategorySelect = 'selected';
    $classCategoryCheck = 'checked';
    break;
  case 'classPeopleLimit':
    $sql .= "ORDER BY `class`.`classPeopleLimit` ";
    if ($_SESSION['classPeopleLimitSequence'] === 'ASC') {
      $sql .= "ASC ";
    } elseif ($_SESSION['classPeopleLimitSequence'] === 'DESC') {
      $sql .= "DESC ";
    }
    $classPeopleLimitSelect = 'selected';
    $classPeopleLimitCheck = 'checked';
    break;
  case 'classDate':
    $sql .= "WHERE `class`.`classDate` LIKE '%{$_SESSION['classDate']}%' ";
    $sql .= "ORDER BY `class`.`id` ASC ";
    $classDateCheck = 'checked';
}

//找到條件塞選過後的課程,之後再依照課程多寡製作分頁
$sqlTotal = "SELECT COUNT(1) FROM ({$sql}) AS `requireSql` ";
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0];

$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total / $numPerPage); // 總頁數
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1


//找到所有課程
$sqlTotalClass = "SELECT count(1) FROM `class` ";
$totalClass = $pdo->query($sqlTotalClass)->fetch(PDO::FETCH_NUM)[0];
?>

<!-- #################### content #################### -->
<style>
  /* class zone */
  .allSelected {
    color: #aaa;
    border-bottom: 1px solid #bbb;
    text-decoration: none;
  }

  .allSelected:hover {
    color: black;
    text-decoration: none;
  }

  ._tr {
    cursor: no-drop;
    opacity: .5;
  }

  ._td {
    vertical-align: middle !important;
  }

  .page {
    font-size: 24px;
  }
</style>
<div class="d-flex">
  <button class="btn btn-outline-secondary my-3 mx-3" type="button" data-toggle="collapse" data-target="#searchDivDetail" aria-expanded="false" aria-controls="searchDivDetail">
    課程搜尋
  </button>
  <a class="btn btn-outline-secondary my-3 mr-3" href="./editClass.php">新增商品</a>
</div>
<div class="collapse" id="searchDivDetail">
  <form method="POST" action="classManagement.php">
    <div class="col-3 mt-2">
      <div class="input-group pb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="radio" name="class" id="className" value="className" <?php echo $classNameCheck ?>>
          </div>
        </div>
        <label class="input-group-text" for="className">名稱:</label>
        <input class="form-control" type="text" name="searchName" value="<?php echo $_SESSION['searchName'] ?>">
      </div>
      <div class="input-group pb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="radio" name="class" id="classPrice" value="classPrice" <?php echo $classPriceCheck ?>>
          </div>
        </div>
        <label class="input-group-text" for="classPrice">價格:</label>
        <input class="form-control" type="text" name="miniPrice" placeholder="" value="<?php echo $_SESSION['miniPrice'] ?>"> -
        <input class="form-control" type="text" name="maxPrice" placeholder="" value="<?php echo $_SESSION['maxPrice'] ?>">
      </div>
      <div class="input-group pb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="radio" name="class" id="classCategories" value="classCategories" <?php echo $classCategoryCheck ?>>
          </div>
        </div>
        <label class="input-group-text" for="classCategories">課程類別:</label>
        <select class="custom-select" name="classCategory" id="">
          <option value="c_perfume" <?php if ($_SESSION['classCategory'] === 'c_perfume') echo $classCategorySelect ?>>香水體驗</option>
          <option value="c_soap" <?php if ($_SESSION['classCategory'] === 'c_soap') echo $classCategorySelect ?>>香皂體驗</option>
        </select>
      </div>
      <div class="input-group pb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="radio" name="class" id="classPeopleLimit" value="classPeopleLimit" <?php echo $classPeopleLimitCheck ?>>
          </div>
        </div>
        <label class="input-group-text" for="classPeopleLimit">人數排序:</label>
        <select class="custom-select" name="classPeopleLimitSequence" id="">
          <option value="DESC" <?php if ($_SESSION['classPeopleLimitSequence'] === 'DESC') echo $classPeopleLimitSelect ?>>大至小</option>
          <option value="ASC" <?php if ($_SESSION['classPeopleLimitSequence'] === 'ASC') echo $classPeopleLimitSelect ?>>小至大</option>
        </select>
      </div>
      <div class="input-group pb-4">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="radio" name="class" id="classDate" value="classDate" <?php echo $classDateCheck ?>>
          </div>
        </div>
        <label class="input-group-text" for="classDate">日期:</label>
        <input class="form-control" type="text" name='classDate' value="<?php echo $_SESSION['classDate'] ?>">
      </div>
      <div class="d-flex">
        <input class="btn btn-outline-info mr-3" type="submit" value="查詢">
        <a class="_btn btn btn-outline-secondary" href="javascript:;">重新搜尋</a>
        <!-- <input class="btn btn-outline-secondary ml-2" type="reset" value="重新搜尋"> -->
      </div>
    </div>
  </form>
</div>

<?php
//若有建立商品種類，則顯示商品清單
if ($totalClass > 0) {
?>
  <form method="POST" enctype="multipart/form-data" action="../action/deleteClass.php">
    <input type="hidden" name="pageNum" value="<?php echo $page ?>">
    <table class="table table-striped table-gray text-center">
      <thead class="thead-light">
        <tr>

          <th class="border"><a class="allSelected" href="javascript:;">全選</a></th>
          <th class="border">課程名稱</th>
          <th class="border">課程價格</th>
          <th class="border">課程類別</th>
          <th class="border">上限人數</th>
          <th class="border">上課日期</th>
          <th class="border">上線時間</th>
          <th class="border">詳細資訊</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql .= "LIMIT ?, ? ";
        //設定繫結值
        $arrParam = [($page - 1) * $numPerPage, $numPerPage];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        //若數量大於 0，則列出商品
        if ($stmt->rowCount() > 0) {
          $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
          for ($i = 0; $i < count($arr); $i++) {
        ?>
            <tr class="<?php if ($arr[$i]['isAlive'] === '停課') echo '_tr' ?>">
              <td class="border classTd _td">
                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['id']; ?>" />
              </td>
              <td class="border _td input<?php echo $i ?>"><?php echo $arr[$i]['className']; ?></td>
              <td class="border _td input<?php echo $i ?>"><?php echo $arr[$i]['classPrice']; ?></td>
              <td class="border _td input<?php echo $i ?>"><?php echo $arr[$i]['classCategoryName']; ?></td>
              <td class="border _td input<?php echo $i ?>"><?php echo $arr[$i]['classPeopleLimit']; ?></td>
              <td class="border _td input<?php echo $i ?>"><?php echo $arr[$i]['classDate']; ?></td>
              <td class="border _td input<?php echo $i ?>"><?php echo $arr[$i]['classTime']; ?></td>
              <td class="border _td">
                <a class="btn btn-outline-secondary" href="./classInfo.php?id=<?php echo $arr[$i]['id'] ?>">修改</a>
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
          <td class="border text-left" colspan="8">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
              <a class="mr-2 page" href="?page=<?= $i ?>"><?= $i ?></a>
            <?php } ?>
          </td>
        </tr>
        <?php if ($total > 0) { ?>
          <tr>
            <td class="border text-left" colspan="8"><input class="btn btn-outline-danger" type="submit" name="smb" value="下架"></td>
          </tr>
        <?php } ?>

      </tfoot>
    </table>
  </form>

  <script>
    document.querySelector('._btn').addEventListener('click', function() {
      let classRadio = document.querySelectorAll('input[type=radio]')
      let classText = document.querySelectorAll('input[type=text]')
      let classSelect = document.querySelectorAll('select')
      classSelect.forEach(el => {
        el.options[0].setAttribute('selected', true)
      })
      classRadio.forEach(el => {
        el.removeAttribute('checked')
      })
      classText.forEach(el => {
        el.value = null;
      })
    })

    document.querySelector('.allSelected').addEventListener('click', function() {
      let _checkBox = document.querySelectorAll('input[type=checkbox]')
      _checkBox.forEach(el => {
        el.hasAttribute('checked') ? el.removeAttribute('checked') : el.setAttribute('checked', true)
      })
    })
  </script>

<?php
} else {
  //引入尚未建立商品種類的文字描述
  require_once('../templates/noCategory.php');
}
require_once('../templates/footer.php'); //引入footer
?>