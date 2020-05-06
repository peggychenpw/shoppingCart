<?php
error_reporting(0);

require_once('../action/checkShop.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

if ($_POST['refresh'] == 'yes') {
  //回傳狀態
  $objResponse = [];

  //判斷有無這個使用者存在
  $sqlCheckUser = "SELECT `userName`
                     FROM `users`
                     WHERE `userId` = ? ";

  $arrCheck = [
    $_POST['userId']
  ];

  $stmtCheck = $pdo->prepare($sqlCheckUser);
  $stmtCheck->execute($arrCheck);

  //如果該使用者存在
  if ($stmtCheck->rowCount() !== 0) {
    //找課程價格及人數限制
    $sqlFindClass = "SELECT `classPrice`, `classPeopleLimit`
                     FROM `class`
                     WHERE `classId` = ? ";

    $arrFindClass = [
      $_POST['classChoice']
    ];

    $stmtFindclass = $pdo->prepare($sqlFindClass);
    $stmtFindclass->execute($arrFindClass);

    $arrFindClass = $stmtFindclass->fetchAll(PDO::FETCH_ASSOC)[0];

    $bookPrice = $arrFindClass['classPrice'];
    $classPeopleLimit = $arrFindClass['classPeopleLimit'];


    //找目前上課人數
    $sqlFindPeople = "SELECT `bookQty`
                          FROM `book`
                          WHERE `classId` = '{$_POST['classChoice']}'
                          AND `bookStatus` = '成功'";

    $stmtFindPeople = $pdo->query($sqlFindPeople);
    $arrFindPeople = $stmtFindPeople->fetchAll(PDO::FETCH_ASSOC);

    if (count($arrFindPeople) == 0) {
      $currentPeople = 0;
    } else {
      for ($i = 0; $i < count($arrFindPeople); $i++) {
        $currentPeople += $arrFindPeople[$i]['bookQty'];
      }
    }


    //判斷報名人數是否超過課程人數上限
    if ($_POST['bookQty'] + $currentPeople <= $classPeopleLimit && $_POST['bookQty'] > 0) {
      //SQL 敘述
      $sql = "INSERT INTO `book` (`classId`, `userId`, `bookStatus`, `bookQty`,`bookPrice`) 
                VALUES (?, ?, ?, ?, ?)";

      //繫結用陣列
      $arrParam = [
        $_POST['classChoice'],
        $_POST['userId'],
        "成功",
        $_POST['bookQty'],
        $bookPrice
      ];

      $stmt = $pdo->prepare($sql);
      $stmt->execute($arrParam);

      //增加bookId
      $bookId = sprintf("B%05d", $pdo->lastInsertId());
      $sqlUpdateClassId =  "UPDATE `book` 
                              SET `bookId` = '{$bookId}'
                              WHERE `id` = '{$pdo->lastInsertId()}'";
      $pdo->query($sqlUpdateClassId);
    }
  }
}

?>
<?php
date_default_timezone_set('Asia/Taipei');
$dateToday =  date("Y-m-d");

$sql = "SELECT `classId`, `classDate`,`className`, `isAlive`
        FROM `class`
        INNER JOIN `shop`
        ON `class`.`shopId` = `shop`.`shopId`
        WHERE `classDate` > '{$dateToday}'
        AND `class`.`shopId` = '{$_SESSION['shopId']}'";

$stmtClass = $pdo->query($sql);
$arr = $stmtClass->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// echo $sql;
// print_r($arr);
// echo "</pre>";

require_once('../templates/header.php');
require_once('../templates/shopLeftSideBar.php');
require_once('../templates/rightContainer.php');
?>
<style>
  ._td {
    vertical-align: middle !important;
  }
</style>

<div class="d-flex align-items-center">
  <button class="btn btn-outline-info my-3 mx-3" type="button">
    預約新課程
  </button>
  <input class="btn btn-outline-secondary ml-1 mr-2" type="button" value="返回" onclick="location.href='./shopBookSearch.php?page=<?php echo $_GET['page'] ?>'">
</div>
<form name="myForm" enctype="multipart/form-data" method="POST" action="./shopBookNew.php?page=<?php echo $_GET['page'] ?>">
  <table class="table table-striped table-gray text-center">
    <thead class="thead-light">
      <tr>
        <th class="border _td">會員編號</th>
        <th class="border _td">課程選擇</th>
        <th class="border _td">預約人數</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="border _td">
          <input class="form-control" type="text" name="userId" value="<?php if (!isset($stmt)) {
                                                                          echo $_POST['userId'];
                                                                        } ?>" maxlength="100" required />
        </td>
        <td class="border _td">
          <select class="custom-select" name="classChoice">
            <?php for ($i = 0; $i < count($arr); $i++) { ?>
              <option value="<?php echo $arr[$i]['classId'] ?>" <?php if ($arr[$i]['isAlive'] == '停課') {
                                                                  echo 'disabled';
                                                                }
                                                                if ($arr[$i]['classId'] == $_POST['classChoice']) {
                                                                  echo 'selected';
                                                                } ?>><?php echo $arr[$i]['classId'] . " - " . $arr[$i]['classDate'] . " - " . $arr[$i]['className'] ?></option>
            <?php } ?>
          </select>
        </td>
        <td class="border _td">
          <input class="form-control" type="text" name="bookQty" value="<?php if (!isset($stmt)) {
                                                                          echo $_POST['bookQty'];
                                                                        } ?>" maxlength="3" required />
        </td>
      </tr>
    </tbody>
    <tfoot>
      <div>
        <td class="border _td text-left" colspan="3">
          <input class="btn btn-outline-info" type="submit" name="smb" value="新增">
        </td>
      </div>
    </tfoot>
  </table>
  <input type="hidden" name="refresh" value="yes">
</form>

<?php
//若無該使用者
if (isset($stmtCheck) && $stmtCheck->rowCount() == 0) {
?>
  <script>
    setTimeout(() => {
      alert("無該使用者")
    }, 100);
  </script>
<?php
}
//如果課程人數已滿
if (isset($currentPeople) && $_POST['bookQty'] + $currentPeople > $classPeopleLimit) {
  $spaceLeft = $classPeopleLimit - $currentPeople
?>
  <script>
    setTimeout(() => {
      alert("報名人數超過課程上限，目前僅剩 " + <?php echo $spaceLeft ?> + " 個名額")
    }, 100);
  </script>
<?php
}
//若人數為0
if (isset($_POST['bookQty']) && $_POST['bookQty'] <= 0) {
?>
  <script>
    setTimeout(() => {
      alert("預約人數須填入大於0的數字")
    }, 100);
  </script>
  <?php
};

if (isset($stmt)) {
  //若新增成功，則在下面顯示新增資料
  if ($stmt->rowCount() > 0) {
    $sqlJustAdded = "SELECT `book`.`bookId`, `book`.`classId`, `class`.`className`, `class`.`classDate`,`class`.`classTime`, `book`.`userId`, `users`.`userName`, `book`.`bookStatus`, `class`.`isAlive`, `book`.`bookQty`,`book`.`created_at` 
        FROM `book`  
        INNER JOIN `class`
        ON `book`.`classId` = `class`.`classId`
        INNER JOIN `users`
        ON `book`.`userId` = `users`.`userId`
        WHERE `bookId` = '{$bookId}'";

    $stmtJustAdded = $pdo->query($sqlJustAdded);
    $arrJustAdded = $stmtJustAdded->fetchAll(PDO::FETCH_ASSOC)[0];

    // print_r($arrJustAdded);
  ?>
    <h4 class="ml-3">剛新增資料</h4>
    <table class="border table table-striped table-gray text-center">
      <thead class="thead-light">
        <tr>
          <th class="border _td">預約編號</th>
          <th class="border _td">課程編號</th>
          <th class="border _td">課程名稱</th>
          <th class="border _td">課程日期</th>
          <th class="border _td">課程時間</th>
          <th class="border _td">會員編號</th>
          <th class="border _td">會員名稱</th>
          <th class="border _td">預約狀態</th>
          <th class="border _td">課程狀態</th>
          <th class="border _td">預約人數</th>
          <th class="border _td">新增時間</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="border _td"><?php echo $arrJustAdded['bookId']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['classId']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['className']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['classDate']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['classTime']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['userId']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['userName']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['bookStatus']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['isAlive']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['bookQty']; ?></td>
          <td class="border _td"><?php echo $arrJustAdded['created_at']; ?></td>
      </tbody>
    </table>
<?php
  } else {
    $objResponse['success'] = false;
    $objResponse['code'] = 500;
    $objResponse['info'] = "新增資料失敗";
    echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
    // exit();
  };
}
?>

<?php
require_once('../templates/footer.php');
?>