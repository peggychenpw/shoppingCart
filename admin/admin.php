<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('../db.inc.php'); //引用資料庫連線


$sqlTotal = "SELECT count(1) FROM `items`"; //SQL 敘述
$total = $pdo->query($sqlTotal)->fetch(PDO::FETCH_NUM)[0]; //取得總筆數
$numPerPage = 5; //每頁幾筆
$totalPages = ceil($total/$numPerPage); // 總頁數
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; //目前第幾頁
$page = $page < 1 ? 1 : $page; //若 page 小於 1，則回傳 1



//商品種類 SQL 敘述
$sqlTotalCatogories = "SELECT count(1) FROM `categories`";

//取得商品種類總筆數
$totalCatogories = $pdo->query($sqlTotalCatogories)->fetch(PDO::FETCH_NUM)[0];
?>
<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
    <style>
    .border {
        border: 1px solid;
    }
    img.itemImg {
        width: 250px;
    }
    </style>
</head>
<body>
<?php require_once('./templates/title.php'); ?>
<hr />
<h3>商品列表</h3>
<?php 
//若有建立商品種類，則顯示商品清單
if($totalCatogories > 0) {
?>
<form name="myForm" entype= "multipart/form-data" method="POST" action="delete.php">
    <table class="border">
        <thead>
            <tr>
                <th class="border">勾選</th>
                <th class="border">課程名稱</th>
                <th class="border">課程圖片</th>
                <th class="border">課程價格</th>
                <th class="border">人數限制</th>
                <th class="border">課程分類</th>
                <th class="border">上課時間</th>
                <th class="border">開課廠商</th>
                <th class="border">功能</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //SQL 敘述
        $sql = "SELECT `class`.`classId`,`class`.`className`,`class`.`classImg`,`class`.`classPrice`,`class`.`classPeopleLimit`,`c`.`classCategoryName`,
                `class`.`classTime`,`s`.`shopName`
                FROM `class` LEFT JOIN `shop` AS `s`
                ON `class`.`shopId` = `s`.`shopId`
                INNER JOIN `classCategory` AS `c`
                ON `class`.`classCategoryId` = `c`.classCategoryId                
                ORDER BY `class`.`classCategoryId` ASC 
                LIMIT ?,?";

        //設定繫結值
        $arrParam = [($page - 1) * $numPerPage, $numPerPage];

        //查詢分頁後的商品資料
        $stmt = $pdo->prepare($sql);
        $stmt->execute($arrParam);
        //若數量大於 0，則列出商品
        if($stmt->rowCount() > 0) {
            $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
            for($i = 0; $i < count($arr); $i++) {
        ?>
            <tr>
                <td class="border">
                    <input type="checkbox" name="chk[]" value="<?php echo $arr[$i]['classId']; ?>" />
                </td>
                <td class="border"><?php echo $arr[$i]['className']; ?></td>
                <td class="border"><img class="itemImg" src="../images/items/<?php echo $arr[$i]['classImg']; ?>" /></td>
                <td class="border"><?php echo $arr[$i]['classPrice']; ?></td>
                <td class="border"><?php echo $arr[$i]['classPeopleLimit']; ?></td>
                <td class="border"><?php echo $arr[$i]['classCategoryName']; ?></td>
                <td class="border"><?php echo $arr[$i]['classTime']; ?></td>
                <td class="border"><?php echo $arr[$i]['shopName']; ?></td>
                <td class="border">
                    <a class='popupBtn' href="javascript:;">點擊</a>|
                    <a href="./edit.php?itemId=<?php echo $arr[$i]['classId']; ?>">商品編輯</a> | 
                    <a href="./multipleImages.php?itemId=<?php echo $arr[$i]['classId']; ?>">多圖設定</a> | 
                    <a href="./comments.php?itemId=<?php echo $arr[$i]['classId']; ?>">回覆評論</a>
                </td>
            </tr>
        <?php
            }
        } else {
        ?>
            <tr>
                <td class="border" colspan="9">沒有資料</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="border" colspan="9">
                <?php for($i = 1; $i <= $totalPages; $i++){ ?>
                    <a href="?page=<?=$i?>"><?= $i ?></a>
                <?php } ?>
                </td>
            </tr>
            
            <?php if($total > 0) { ?>
            <tr>
                <td class="border" colspan="9"><input type="submit" name="smb" value="刪除"></td>
            </tr>
            <?php } ?>
            
        </tfoo>
    </table>
</form>
<?php 
} else { 
    //引入尚未建立商品種類的文字描述
    require_once('./templates/noCategory.php');
}?>

<script>
        let popupBtn = document.querySelector('.popupBtn');
        popupBtn.addeventlistener('click', =>() {
            let _div = document.createElement
        })      
</script>
</body>
</html>