<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');

if (isset($_GET['id'])) {

  $sql = "SELECT `class`.`id`,`class`.`classId`,`class`.`classImg`,`class`.`classPeopleLimit`,`class`.`classPrice`,
                 `classcategory`.`classCategoryName`,`class`.`classDate`,`class`.`classTime`,`shop`.`shopName`,
                 `class`.`created_at`,`class`.`updated_at`
          FROM   `class` INNER JOIN `classcategory`
          ON     `class`.`classCategoryId` = `classcategory`.`classCategoryId`
          INNER JOIN `shop`
          ON     `class`.`shopId` = `shop`.`shopId`
          WHERE `class`.`id` = ? ";

  $stmt = $pdo->prepare($sql);
  $arrParam = [$_GET['id']];
  $stmt->execute($arrParam);

  if ($stmt->rowCount() > 0) {
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
?>
    <label for="classId">課程編號：</label>
    <input type="text" id="classId" value="<?php echo $arr['classId'] ?>">
    <br>
    <label for="classImg">課程圖片:</label>
    <input type="text" id="classImg" value="<?php echo $arr['classImg'] ?>">
    <br>
    <label for="classPeopleLimit">人數上限:</label>
    <input type="text" id="classPeopleLimit" value="<?php echo $arr['classPeopleLimit'] ?>">
    <br>
    <label for="classPrice">課程價格:</label>
    <input type="text" id="classPrice" value="<?php echo $arr['classPrice'] ?>">
    <br>
    <label for="classCategoryName">課程類別:</label>
    <input type="text" id="classCategoryName" value="<?php echo $arr['classCategoryName'] ?>">
    <br>
    <label for="classDate">課程日期</label>
    <input type="text" id="classDate" value="<?php echo $arr['classDate'] ?>">
    <label for="classTime">課程時間</label>
    <input type="text" id="classTime" value="<?php echo $arr['classTime'] ?>">
    <label for="shopName">廠商名稱</label>
    <input type="text" id="shopName" value="<?php echo $arr['shopName'] ?>">
    <label for="created_at">新增時間</label>
    <input type="text" id="created_at" value="<?php echo $arr['created_at'] ?>" disabled>
    <label for="updated_at">更新時間</label>
    <input type="text" id="updated_at" value="<?php echo $arr['updated_at'] ?>" disabled>


<?php
  }
}
require_once('../templates/footer.php'); //引入footer
?>