<?php
session_start();

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

$sql = "SELECT `book`.`bookId`, `book`.`classId`, `class`.`className`, `class`.`classDate`,`class`.`classTime`, `book`.`userId`, `users`.`userName`, `book`.`bookStatus`, `class`.`isAlive`, `book`.`bookQty`,`book`.`created_at`, `book`.`updated_at`  
        FROM `book`  
        INNER JOIN `class`
        ON `book`.`classId` = `class`.`classId`
        INNER JOIN `users`
        ON `book`.`userId` = `users`.`userId`";


//驗證SESSION存在
// echo $_SESSION["searchMethod"];
// echo $_SESSION["searchText"];


//搜尋方式
switch ($_SESSION["searchMethod"]) {
    case "bookId":
        $sql .= "WHERE `book`.`bookId` LIKE '%{$_SESSION['searchText']}%'";
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
    .search-form {
        background: #f7f7f7;
    }

    .search-bar {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .chk-hidden {
        display: none;
    }

    label {
        margin: 1px 0 !important;
    }

    .time-flex {
        align-items: center;
    }

    .time-text {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    button.disabled {
        pointer-events: none;
        color: #999999;
        /* opacity:.5; */
    }

    .input-group-text {
        margin: 0 !important;
        height: 32px;
    }

    .time-select {
        width: 136px;
    }

    .time-range-select {
        width: 540px
    }

    .date-range {
        height: 24px;
        width: 172px;
    }

    .book-status {
        width: 200px;
    }

    .search-order {
        width: 120px;
        height: 32px;
    }

    div .search-order {
        width: 72px;
    }

    .search-order select {
        width: 20px;
        height: 32px;
        font-size: 16px;
        padding: 0 0 0 10px;
        background: #f9f9f9;
    }

    .label-all-chk {
        cursor: pointer;
        color: #999999;
        border-bottom: 2px dotted #999999;
    }

    .label-all-chk:hover {
        color: #777777;
    }

    a.pageSelected {
        pointer-events: none;
        color: #999999;
    }

    .disabled-border {
        cursor: no-drop;
    }

    ._td {
        vertical-align: middle !important;
    }

    .col-form-label {
        margin-bottom: 1px;
        margin-top: 1px;
    }

    input[type="checkbox"] {
        cursor: pointer;
        transform: scale(1.2);
        padding: 20px;
        line-height: 10px;
    }

    .page{
        font-size: 24px;
    }
</style>

<!-- <h3>預約課程列表</h3> -->
<!--       search start              -->

<div class="d-flex justify-content-between">
    <button class="btn btn-outline-secondary my-3 ml-3" type="button" data-toggle="collapse" data-target="#searchDivDetail" aria-expanded="false" aria-controls="searchDivDetail">
        預約查詢
    </button>
    <a class="btn btn-outline-secondary my-3 mr-3" href="./bookNew.php?page=<?php echo $page ?>">預約新課程</a>
</div>
<div class="collapse mt-1 mb-3" id="searchDivDetail">
    <!-- 搜尋功能 -->
    <form class="mx-3 p-3 search-form" name="bookSearchForm" entype="multipart/form-data" method="POST" action="bookSearch2.php">
        <div class="form-group">
            <h5 class="ml-2 mb-2">搜尋方式</h5>
            <div class="input-group">
                <div class="input-group-prepend ">
                    <select class="custom-select search-bar" name="searchMethod">
                        <option value="bookId" <?php echo $bookIdSelect ?>>預約編號</option>
                        <option value="classId" <?php echo $classIdSelect ?>>課程編號</option>
                        <option value="className" <?php echo $classNameSelect ?>>課程名稱</option>
                        <option value="userId" <?php echo $userIdSelect ?>>會員編號</option>
                        <option value="userName" <?php echo $userNameSelect ?>>會員名稱</option>
                    </select>
                </div>
                <input class="form-control" type="text" name="searchText" value="<?php echo $_SESSION['searchText'] ?>">
            </div>
        </div>

        <div class="form-group">
            <h5 class="ml-2 mb-2">搜尋時間</h5>
            <div class="d-flex row time-flex">
                <label class="input-group time-select ml-3 mb-2" for="future">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" id="future" name="searchDirection" value="future" <?php echo $futureCheck ?>>
                        </div>
                    </div>
                    <div class="time-text input-group-text">未來預約</div>
                </label>
                <label class="input-group time-select ml-3 mb-2" for="past">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" id="past" name="searchDirection" value="past" <?php echo $pastCheck ?>>
                        </div>
                    </div>
                    <div class="time-text input-group-text">歷史紀錄</div>
                </label>
                <label class="input-group time-range-select ml-3 mb-2" for="dateRange">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" id="dateRange" name="searchDirection" value="dateRange" <?php echo $dateRangeCheck ?>>
                        </div>
                    </div>
                    <div class="time-text input-group-text"> 時間範圍
                        <input class="mx-2 date-range form-control" id="dateStart" type="date" name="searchStartDate" value="<?php echo $_SESSION['searchStartDate'] ?>"> -
                        <input class="mx-2 date-range form-control" id="dateEnd" type="date" name="searchEndDate" value="<?php echo $_SESSION['searchEndDate'] ?>">
                    </div>
                </label>
            </div>
        </div>
        <div class="form-group">
            <h5 class="ml-2 mb-2">預約狀態</h5>
            <select class="custom-select book-status" name="searchStatus" id="">
                <option value="all" <?php echo $allSelect ?>>全部</option>Ï
                <option value="success" <?php echo $successSelect ?>>成功</option>
                <option value="cancelled" <?php echo $cancelledSelect ?>>取消</option>
            </select>
        </div>
        <div class="form-group">
            <h5 class="ml-2 mb-2">排序方式</h5>
            <div class="d-flex row time-flex">
                <label class="input-group time-select ml-3 mb-2" for="byClassDate">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" id="byClassDate" name="sortOrder" value="byClassDate" <?php echo $byClassDateCheck ?>>
                        </div>
                    </div>
                    <div class="time-text input-group-text">課程時間</div>
                </label>
                <label class="input-group time-select ml-1 mb-2" for="byBookId">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" id="byBookId" name="sortOrder" value="byBookId" <?php echo $byBookIdCheck ?>>
                        </div>
                    </div>
                    <div class="time-text input-group-text">預約編號</div>
                </label>
                <label class="input-group time-select ml-1 mb-2" for="byClassId">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" id="byClassId" name="sortOrder" value="byClassId" <?php echo $byClassIdCheck ?>>
                        </div>
                    </div>
                    <div class="time-text input-group-text">課程編號</div>
                </label>
                <label class="input-group time-select ml-1 mb-2" for="byUserId">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" id="byUserId" name="sortOrder" value="byUserId" <?php echo $byUserIdCheck ?>>
                        </div>
                    </div>
                    <div class="time-text input-group-text">會員編號</div>
                </label>
                <div class="input-group search-order ml-1 mb-2">
                    <select class="custom-select" name="searchOrder" id="">
                        <option value="forward" <?php echo $forwardSelect ?>>小至大</option>
                        <option value="backforward" <?php echo $backforwardSelect ?>>大至小</option>
                    </select>
                </div>
            </div>
        </div>
        <div>
            <input class="btn btn-outline-info" type="submit" name="smbSearch" value="搜尋">
            <a class="btn btn-outline-secondary ml-2" href="bookSearch2.php">重新搜尋</a>
        </div>
    </form>
</div>
<!--       search end              -->
<?php
//若有課程存在，才顯示
if ($totalClasses > 0) {
?>
    <form name="myForm" entype="multipart/form-data" method="POST" action="../action/bookDelete.php?page=<?php echo $page ?>">
        <table class="table table-striped table-gray text-center">
            <thead class="thead-light">
                <tr>
                    <th class="border _td">
                        <input class="chk-hidden" type="checkbox" name="allCheck" id="allCheck">
                        <label class="label-all-chk" for="allCheck">全選</label>
                    </th>
                    <th class="border _td">預約編號</th>
                    <th class="border _td">課程編號</th>
                    <th class="border _td">課程名稱</th>
                    <th class="border _td">課程日期</th>
                    <th class="border _td">課程時間</th>
                    <th class="border _td">會員編號</th>
                    <th class="border _td">會員名稱</th>
                    <th class="border _td">預約狀態</th>
                    <th class="border _td">課程狀態</th>
                    <th class="border _td">人數</th>
                    <!-- <th class="border _td">新增時間</th> -->
                    <th class="border _td">功能</th>
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
                            <td class="border _td">
                                <input class="chk-delete" type="checkbox" name="chk[]" value="<?php echo $arr[$i]['bookId']; ?>" />
                            </td>
                            <td class="border _td"><?php echo $arr[$i]['bookId']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['classId']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['className']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['classDate']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['classTime']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['userId']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['userName']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['bookStatus']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['isAlive']; ?></td>
                            <td class="border _td"><?php echo $arr[$i]['bookQty']; ?></td>
                            <!-- <td class="border _td"><?php echo $arr[$i]['created_at']; ?></td> -->
                            <td class="border _td <?php if ($arr[$i]['isAlive'] == '停課') {
                                                        echo 'disabled-border';
                                                    } ?>">
                                <button type="button" class="btn btn-outline-secondary <?php if ($arr[$i]['isAlive'] == '停課') {
                                                                                            echo 'disabled';
                                                                                        } ?>" data-toggle="modal" data-target="#bookModify<?php echo $i ?>" data-whatever="@mdo">修改</button>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td class="border" colspan="13">沒有資料</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="border" colspan="13">
                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                            <a class="p-2 page <?php if ($page == $i) {
                                            echo 'pageSelected';
                                        } ?>" href="?page=<?= $i ?>"><?= $i ?></a>
                        <?php } ?>
                    </td>
                </tr>

                <?php if ($total > 0) { ?>
                    <tr>
                        <td class="border" colspan="13"><input class="btn btn-outline-danger" type="submit" name="smb" value="刪除預約"></td>
                    </tr>
                <?php } ?>

            </tfoot>
        </table>
    </form>
    <?php for ($i = 0; $i < count($arr); $i++) { ?>
        <div class="modal fade" id="bookModify<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="bookModifyLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-3" id="bookModifyLabel<?php echo $i ?>">修改預約</h5>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </div>
                    <form name="modifyForm<?php echo $i ?>" entype="multipart/form-data" method="POST" action="../action/bookUpdate2.php?page=<?php echo $page ?>&bookId=<?php echo $arr[$i]['bookId'] ?>&classId=<?php echo $arr[$i]['classId'] ?>">
                        <div class="modal-body">
                            <div class="form-group container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="book-id<?php echo $i ?>" class="col-form-label ml-1">預約編號</label>
                                        <input type="text" class="form-control" id="book-id<?php echo $i ?>" value="<?php echo $arr[$i]['bookId']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="user-id<?php echo $i ?>" class="col-form-label ml-1">會員編號</label>
                                        <input type="text" class="form-control" id="user-id<?php echo $i ?>" value="<?php echo $arr[$i]['userId']; ?>" disabled>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="user-name<?php echo $i ?>" class="col-form-label ml-1">會員名稱</label>
                                        <input type="text" class="form-control" id="user-name<?php echo $i ?>" value="<?php echo $arr[$i]['userName']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="class-id<?php echo $i ?>" class="col-form-label ml-1">課程編號</label>
                                        <input type="text" class="form-control" id="class-id<?php echo $i ?>" value="<?php echo $arr[$i]['classId']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="class-name<?php echo $i ?>" class="col-form-label ml-1">課程名稱</label>
                                        <input type="text" class="form-control" id="class-name<?php echo $i ?>" value="<?php echo $arr[$i]['className']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="class-date<?php echo $i ?>" class="col-form-label ml-1">課程日期</label>
                                        <input type="text" class="form-control" id="class-date<?php echo $i ?>" value="<?php echo $arr[$i]['classDate']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="class-time<?php echo $i ?>" class="col-form-label ml-1">課程時間</label>
                                        <input type="text" class="form-control" id="class-time<?php echo $i ?>" value="<?php echo $arr[$i]['classTime']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p for="" class="col-form-label ml-1">預約狀態</p>
                                        <select class="custom-select" name="bookStatusSelect">
                                            <option value="成功" <?php if ($arr[$i]['bookStatus'] == "成功") {
                                                                    echo "selected";
                                                                } ?>>成功</option>
                                            <option value="取消" <?php if ($arr[$i]['bookStatus'] == "取消") {
                                                                    echo "selected";
                                                                } ?>>取消</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 mb-0">
                                        <label for="book-qty<?php echo $i ?>" class="col-form-label ml-1">預約人數</label>
                                        <input type="text" class="form-control" name="bookQtyChange" id="book-qty<?php echo $i ?>" value="<?php echo $arr[$i]['bookQty']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="add-time<?php echo $i ?>" class="col-form-label ml-1">新增時間</label>
                                        <input type="text" class="form-control" id="add-time<?php echo $i ?>" value="<?php echo $arr[$i]['created_at']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="modify-time<?php echo $i ?>" class="col-form-label ml-1">更新時間</label>
                                        <input type="text" class="form-control" id="modify-time<?php echo $i ?>" value="<?php echo $arr[$i]['updated_at']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-outline-secondary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <?php } ?>
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