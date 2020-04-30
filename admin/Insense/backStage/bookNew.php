<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
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

        for ($i = 0; $i < count($arrFindPeople); $i++) {
            $currentPeople += $arrFindPeople[$i]['bookQty'];
        }

        //判斷報名人數是否超過課程人數上限
        if ($_POST['bookQty'] + $currentPeople < $classPeopleLimit) {
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

            if ($stmt->rowCount() > 0) {
                header("Refresh: 1; url=../backStage/bookNew.php");
                $objResponse['success'] = true;
                $objResponse['code'] = 200;
                $objResponse['info'] = "新增成功";
                echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
            } else {
                header("Refresh: 1; url=../backStage/bookNew.php");
                $objResponse['success'] = false;
                $objResponse['code'] = 500;
                $objResponse['info'] = "沒有新增資料";
                echo json_encode($objResponse, JSON_UNESCAPED_UNICODE);
                exit();
            };

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

$sql = "SELECT `classId`, `classDate`,`className`
        FROM `class`
        WHERE `classDate`>{$dateToday}";

$stmt = $pdo->query($sql);
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// print_r($arr);
// echo "</pre>";

require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>

<h3>新增預約</h3>
<form name="myForm" enctype="multipart/form-data" method="POST" action="./bookNew.php">
    <table class="border">
        <thead>
            <tr>
                <th class="border">會員編號</th>
                <th class="border">課程選擇</th>
                <th class="border">預約人數</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border">
                    <input type="text" name="userId" value="<?php echo $_POST['userId'] ?>" maxlength="100" required />
                </td>
                <td class="border">
                    <select name="classChoice">
                        <?php for ($i = 0; $i < count($arr); $i++) { ?>
                            <option value="<?php echo $arr[$i]['classId'] ?>"><?php echo $arr[$i]['classId'] . " - " . $arr[$i]['classDate'] . " - " . $arr[$i]['className'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td class="border">
                    <input type="text" name="bookQty" value="<?php echo $_POST['bookQty'] ?>" maxlength="3" required />
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="border" colspan="3"><input type="submit" name="smb" value="新增"></td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="refresh" value="yes">

</form>
<?php
require_once('../templates/footer.php');
?>

<?php if ($stmtCheck->rowCount() == 0) {
?>
    <script>
        setTimeout(() => {
            alert("無該使用者")
        }, 100);
    </script>
<?php
}
if ($_POST['bookQty'] + $currentPeople > $classPeopleLimit) {
    $spaceLeft = $classPeopleLimit - $currentPeople

?>
    <script>
        setTimeout(() => {
            alert("報名人數超過課程上限，目前僅剩"+ <?php echo $spaceLeft?> + "個空位")
        }, 100);
    </script>
<?php
}

?>