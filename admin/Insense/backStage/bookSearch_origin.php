<?php
// session_start();
error_reporting(0);

require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

// echo $_POST['searchMethod'];
// exit();

date_default_timezone_set('Asia/Taipei');
$dateToday =  date("Y-m-d");

//每次剛進入預約查詢，清空SESSION，以利重新查詢
if (!isset($_GET['page'])) {
    $_SESSION['searchMethod'] = "";
    $_SESSION['searchText'] = "";
    $_SESSION['searchStatus'] = "all";
    $_SESSION['searchDirection'] = "dateRange";
    $_SESSION['searchStartDate'] = "";
    $_SESSION['searchEndDate'] = "";
    $_SESSION['sortOrder'] = "byClassDate";
    $_SESSION['searchOrder'] = "forward";
}

//關鍵字查詢後，可跳頁，並保持查詢方式
if (isset($_POST["searchMethod"])) {
    //驗證有無進去判斷
    // echo "yes";
    $_SESSION['searchMethod'] = $_POST['searchMethod'];
    $_SESSION['searchText'] = $_POST['searchText'];
    $_SESSION['searchStatus'] = $_POST['searchStatus'];
    $_SESSION['searchDirection'] = $_POST['searchDirection'];
    $_SESSION['searchStartDate'] = $_POST['searchStartDate'];
    $_SESSION['searchEndDate'] = $_POST['searchEndDate'];
    $_SESSION['sortOrder'] = $_POST['sortOrder'];
    $_SESSION['searchOrder'] =  $_POST['searchOrder'];
}


$sql = "SELECT `book`.`bookId`, `book`.`classId`, `class`.`className`, `class`.`classDate`,`class`.`classTime`, `book`.`userId`, `users`.`userName`, `book`.`bookStatus`, `class`.`isAlive`, `book`.`bookQty`,`book`.`created_at` 
        FROM `book`  
        INNER JOIN `class`
        ON `book`.`classId` = `class`.`classId`
        INNER JOIN `users`
        ON `book`.`userId` = `users`.`userId`";


//驗證SESSION存在
// echo $_SESSION["searchMethod"];
// echo $_SESSION["searchText"];

function getSql($colFirst, $colSec)
{
    $searchSql = "WHERE `$colFirst`.`$colSec` LIKE '%{$_SESSION['searchText']}%'";
    return $searchSql;
}

// echo getSql('book','bookId');
// exit();

//搜尋方式
switch ($_SESSION["searchMethod"]) {
    case "bookId":
        $sql .= getSql('book', 'bookId');
        // echo $sql;
        // $sql .= "WHERE `book`.`bookId` LIKE '%{$_SESSION['searchText']}%'";
        $bookIdSelect = "selected";
        break;
    case "classId":
        $sql .= "WHERE `class`.`classId` LIKE '%{$_SESSION["searchText"]}%'";
        $classIdSelect = "selected";
        break;
    case "className":
        $sql .= "WHERE `class`.`className` LIKE '%{$_SESSION["searchText"]}%'";
        $classNameSelect = "selected";
        break;
    case "userId":
        $sql .= "WHERE `book`.`userId` LIKE '%{$_SESSION["searchText"]}%'";
        $userIdSelect = "selected";
        break;
    case "userName":
        $sql .= "WHERE `users`.`userName` LIKE '%{$_SESSION["searchText"]}%'";
        $userNameSelect = "selected";
        break;
}

//預約狀態
switch ($_SESSION['searchStatus']) {
    case "all":
        $allSelect = "selected";
        break;
    case "success":
        $sql .= "AND `book`.`bookStatus` = '成功'";
        $successSelect = "selected";
        break;
    case "cancelled":
        $sql .= "AND `book`.`bookStatus` = '取消'";
        $cancelledSelect = "selected";
        break;
}

//搜尋時間
switch ($_SESSION['searchDirection']) {
    case "future":
        $sql .= "AND `class`.`classDate` >= '{$dateToday}'";
        $futureCheck = 'checked="true"';
        break;
    case "past":
        $sql .= "AND `class`.`classDate` <= '{$dateToday}'";
        $pastCheck = 'checked="true"';
        break;
    case "dateRange":
        $dateRangeCheck = 'checked="true"';
        if ($_SESSION['searchStartDate'] !== "") {
            $sql .= "AND `class`.`classDate` >= '{$_SESSION['searchStartDate']}'";
        }
        if ($_SESSION['searchEndDate'] !== "") {
            $sql .= "AND `class`.`classDate` <= '{$_SESSION['searchEndDate']}'";
        }
}

//排序方式
switch ($_SESSION["sortOrder"]) {
    case "byClassDate":
        $sql .= "ORDER BY `class`.`classDate` ";
        $byClassDateCheck = 'checked="true"';
        break;
    case "byBookId":
        $sql .= "ORDER BY `book`.`bookId` ";
        $byBookIdCheck = 'checked="true"';
        break;
    case "byClassId":
        $sql .= "ORDER BY `class`.`classId` ";
        $byClassIdCheck = 'checked="true"';
        break;
    case "byUserId":
        $sql .= "ORDER BY `book`.`userId` ";
        $byUserIdCheck = 'checked="true"';
        break;
}

//順向或逆向
switch ($_SESSION["searchOrder"]) {
    case "forward":
        $sql .= "ASC ";
        $forwardSelect = "selected";
        break;
    case "backforward":
        $sql .= "DESC ";
        $backforwardSelect = "selected";
        break;
}
// echo $sql;

//換頁
//取得預約總筆數
$sqlTotal = "SELECT count(1) FROM ({$sql}) AS `Sublist`"; //SQL 敘述
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得預約總筆數

// echo "<pre>";
// print_r($total);
// echo "</pre>";
// exit();

$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total / $numPerPage); // 總頁數

//第幾頁
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1
$page = $page > $totalPages ? $totalPages : $page; //若 page 大於 總頁數，則回傳 總頁數

//取得課程總筆數
$sqlTotalClasses = "SELECT count(1) FROM `class`";
$totalClasses = $pdo->query($sqlTotalClasses)->fetch(PDO::FETCH_NUM)[0];

require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
?>
<style>
    a.disabled {
        pointer-events: none;
        color: #999999;
    }
    .disabled-border {
        cursor:no-drop;
    }

</style>

<h3 class=" mt-2 ml-4">預約課程列表</h3>
<!--       search start              -->
<div>
  <button class="btn btn-outline-secondary mt-2 ml-4" type="button" data-toggle="collapse" data-target="#searchDivDetail" aria-expanded="false" aria-controls="searchDivDetail">
    關鍵字搜尋
  </button>
</div>
<div class="collapse" id="searchDivDetail">
  <!-- 搜尋功能 -->
  <form name="bookSearchForm" entype="multipart/form-data" method="POST" action="bookSearch.php">
    <div>
      <span class="ml-4">搜尋方式：</span>
      <select name="searchMethod" id="">
        <option value="bookId" <?php echo $bookIdSelect ?>>預約編號</option>
        <option value="classId" <?php echo $classIdSelect ?>>課程編號</option>
        <option value="className" <?php echo $classNameSelect ?>>課程名稱</option>
        <option value="userId" <?php echo $userIdSelect ?>>會員編號</option>
        <option value="userName" <?php echo $userNameSelect ?>>會員名稱</option>
      </select>
      <input type="text" name="searchText" value="<?php echo $_SESSION['searchText'] ?>">
    </div>

    <div>
      <span class="ml-4">預約狀態：</span>
      <select name="searchStatus" id="">
        <option value="all" <?php echo $allSelect ?>>全部</option>Ï
        <option value="success" <?php echo $successSelect ?>>成功</option>
        <option value="cancelled" <?php echo $cancelledSelect ?>>取消</option>
      </select>
    </div>

    <div>
      <span class="ml-4 mt-4">搜尋時間：</span>
      <input type="radio" id="future" name="searchDirection" value="future" <?php echo $futureCheck ?>>
      <label for="future">未來預約</label>
      <input type="radio" id="past" name="searchDirection" value="past" <?php echo $pastCheck ?>>
      <label for="past">歷史紀錄</label>
      <input type="radio" id="dateRange" name="searchDirection" value="dateRange" <?php echo $dateRangeCheck ?>>
      <label for="dateRange">時間範圍:
        <input id="dateStart" type="date" name="searchStartDate" value="<?php echo $_SESSION['searchStartDate'] ?>"> -
        <input id="dateEnd" type="date" name="searchEndDate" value="<?php echo $_SESSION['searchEndDate'] ?>">
      </label>
    </div>
    <!-- 搜尋功能 -->
    <div>
      <span class="ml-4">排序方式：</span>
      <input type="radio" id="byClassDate" name="sortOrder" value="byClassDate" <?php echo $byClassDateCheck ?>>
      <label for="byClassDate">課程時間</label>
      <input type="radio" id="byBookId" name="sortOrder" value="byBookId" <?php echo $byBookIdCheck ?>>
      <label for="byBookId">預約編號</label>
      <input type="radio" id="byClassId" name="sortOrder" value="byClassId" <?php echo $byClassIdCheck ?>>
      <label for="byClassId">課程編號</label>
      <input type="radio" id="byUserId" name="sortOrder" value="byUserId" <?php echo $byUserIdCheck ?>>
      <label for="byUserId">會員編號</label>
      <select name="searchOrder" id="">
        <option value="forward" <?php echo $forwardSelect ?>>由小至大</option>
        <option value="backforward" <?php echo $backforwardSelect ?>>由大至小</option>
      </select>
    </div>

    <input type="submit" name="smbSearch" class="ml-4">
    <a href="bookSearch.php" class="ml-4">重新搜尋</a>
  </form>

</div>
<!--       search end              -->
<?php
//若有課程存在，才顯示
if ($totalClasses > 0) {
?>
    <form name="myForm" entype="multipart/form-data" method="POST" action="delete.php?page=<?php echo $page?>">
        <table class="border">
            <thead>
                <tr>
                    <th class="border"><input type="checkbox" name="allCheck" id="allCheck">
                        <label for="allCheck">全選</label>
                    </th>
                    <th class="border">預約編號</th>
                    <th class="border">課程編號</th>
                    <th class="border">課程名稱</th>
                    <th class="border">課程日期</th>
                    <th class="border">課程時間</th>
                    <th class="border">會員編號</th>
                    <th class="border">會員名稱</th>
                    <th class="border">預約狀態</th>
                    <th class="border">課程狀態</th>
                    <th class="border">預約人數</th>
                    <th class="border">新增時間</th>
                    <th class="border">功能</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //各頁資料
                $sql .= "LIMIT ?, ? ";
                $arrParam = [($page - 1) * $numPerPage, $numPerPage];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($arrParam);
                // echo $sql;

                //若數量大於 0，則列出商品
                if ($stmt->rowCount() > 0) {

                    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    // echo "<pre>";
                    // print_r($arr);
                    // echo "</pre>";
                    // exit();

                    for ($i = 0; $i < count($arr); $i++) {
                ?>
                        <tr>
                            <td class="border">
                                <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['bookId']; ?>" />
                            </td>
                            <td class="border"><?php echo $arr[$i]['bookId']; ?></td>
                            <td class="border"><?php echo $arr[$i]['classId']; ?></td>
                            <td class="border"><?php echo $arr[$i]['className']; ?></td>
                            <td class="border"><?php echo $arr[$i]['classDate']; ?></td>
                            <td class="border"><?php echo $arr[$i]['classTime']; ?></td>
                            <td class="border"><?php echo $arr[$i]['userId']; ?></td>
                            <td class="border"><?php echo $arr[$i]['userName']; ?></td>
                            <td class="border"><?php echo $arr[$i]['bookStatus']; ?></td>
                            <td class="border"><?php echo $arr[$i]['isAlive']; ?></td>
                            <td class="border"><?php echo $arr[$i]['bookQty']; ?></td>
                            <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
                            <td class="border <?php if($arr[$i]['isAlive']=='停課'){echo 'disabled-border';}?>">
                                <a href="./bookEdit.php?page=<?php echo $page ?>&bookId=<?php echo $arr[$i]['bookId'] ?>" class ="<?php if($arr[$i]['isAlive']=='停課'){echo 'disabled';}?>">資料更改</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td class="border" colspan="11">沒有資料</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="border" colspan="11">
                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                            <a href="?page=<?= $i ?>"><?= $i ?></a>
                        <?php } ?>
                    </td>
                </tr>

                <?php if ($total > 0) { ?>
                    <tr>
                        <td class="border" colspan="11"><input type="submit" name="smb" value="刪除"></td>
                    </tr>
                <?php } ?>

                </tfoo>
        </table>
    </form>
<?php
} else {
    //引入尚未建立商品種類的文字描述
    echo "<div>無任何課程</div>";
} ?>

<?php require_once('../templates/footer.php'); // 最後在引入footer
?>

<script>
    let allCheckFunc = function() {
        let checkbox = document.getElementsByName('chk[]')

        if (document.myForm.allCheck.checked == true) {
            for (i = 0; i < checkbox.length; i++) {
                checkbox[i].checked = true;
            }
        } else {
            for (i = 0; i < checkbox.length; i++) {
                checkbox[i].checked = false;
            }
        }
    }

    document.getElementById('allCheck').addEventListener('click', function() {
        allCheckFunc()
    })
</script>