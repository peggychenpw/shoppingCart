<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');

if (isset($_GET['id'])) {

  $sql = "SELECT `class`.`id`,`class`.`classId`,`class`.`className`,`class`.`classPeopleLimit`,`class`.`classPrice`,
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
    <form method="POST" enctype="multipart/form-data" action="../action/updateClass.php">
      <label for="classId">課程編號：</label>
      <input name="classId" type="text" id="classId" value="<?php echo $arr['classId'] ?>" disabled>
      <br>
      <label for="className">課程名稱:</label>
      <input name="className" type="text" id="className" value="<?php echo $arr['className'] ?>">
      <br>
      <label for="classPeopleLimit">人數上限:</label>
      <input name="classPeopleLimit" type="text" id="classPeopleLimit" value="<?php echo $arr['classPeopleLimit'] ?>">
      <br>
      <label for="classPrice">課程價格:</label>
      <input name="classPrice" type="text" id="classPrice" value="<?php echo $arr['classPrice'] ?>">
      <br>
      <label for="classCategoryId">課程類別:</label>
      <select name="classCategoryId" id="classCategoryId">
        <?php $categoryName = $arr['classCategoryName'] ?>
        <option value="c_perfume" <?php if ($categoryName === '香水體驗') echo 'selected' ?>>香水體驗</option>
        <option value="c_soap" <?php if ($categoryName === '香皂體驗') echo 'selected' ?>>香皂體驗</option>
      </select>
      <br>
      <label for="classDate">課程日期:</label>
      <input name="classDate" type="date" id="classDate" value="<?php echo $arr['classDate'] ?>">
      <br>
      <label for="classTime">課程時間:</label>
      <select name="classTime" id="classTime">
        <?php $default = $arr['classTime'] ?>
        <option value="13:00" <?php if ($default === '13:00') echo 'selected'; ?>>
          13:00
        </option>
        <option value="14:00" <?php if ($default === '14:00') echo 'selected'; ?>>
          14:00
        </option>
        <option value="15:00" <?php if ($default === '15:00') echo 'selected'; ?>>
          15:00
        </option>
      </select>
      <br>
      <label for="shopName">廠商名稱:</label>
      <input type="text" name="shopName" id="shopName" value="<?php echo $arr['shopName'] ?>" disabled>
      <br>
      <label for="created_at">新增時間:</label>
      <input type="text" id="created_at" value="<?php echo $arr['created_at'] ?>" disabled>
      <br>
      <label for="updated_at">更新時間:</label>
      <input type="text" id="updated_at" value="<?php echo $arr['updated_at'] ?>" disabled>
      <br>
      <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>">
      <input type="submit" value="修改">
    </form>

<?php
  }
}
require_once('../templates/footer.php'); //引入footer
?>