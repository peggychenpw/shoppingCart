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
    <div>
      <a href="">
        <div><?php echo $arr['classId'] ?></div>
      </a>
    </div>
    <input type="text" value="<?php echo $arr['classImg'] ?>">
    <input type="text" value="<?php echo $arr['classPeopleLimit'] ?>">
    <input type="text" value="<?php echo $arr['classPrice'] ?>">
    <input type="text" value="<?php echo $arr['classCategoryName'] ?>">
    <input type="text" value="<?php echo $arr['classDate'] ?>">
    <input type="text" value="<?php echo $arr['classTime'] ?>">
    <input type="text" value="<?php echo $arr['shopName'] ?>">
    <input type="text" value="<?php echo $arr['created_at'] ?>" disabled>
    <input type="text" value="<?php echo $arr['updated_at'] ?>" disabled>


<?php
  }
}
require_once('../templates/footer.php'); //引入footer
?>