<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

?>
<?php
require_once('../templates/header.php');
require_once('../templates/shopLeftSideBar.php');
require_once('../templates/rightContainer.php');
?>

<h3>預約更改</h3>
<input class="btn btn-primary" type="button" value="上一頁" onclick="location.href='./shopBookSearch.php?page=<?php echo $_GET['page'] ?>'">

<form name="myForm" enctype="multipart/form-data" method="POST" action="../action/shopBookUpdate.php?page=<?php echo $_GET['page'] ?>">
  <table class="border">
    <thead>
      <tr>
        <th class="border">預約編號</th>
        <th class="border">課程編號</th>
        <th class="border">課程名稱</th>
        <th class="border">課程日期</th>
        <th class="border">課程時間</th>
        <th class="border">會員編號</th>
        <th class="border">會員名稱</th>
        <th class="border">預約狀態</th>
        <th class="border">預約人數</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //SQL 敘述
      $sql = "SELECT `book`.`bookId`, `book`.`classId`, `class`.`className`, `class`.`classDate`,`class`.`classTime`, `book`.`userId`, `users`.`userName`, `book`.`bookStatus`, `book`.`bookQty`,`book`.`created_at` 
                    FROM `book`  
                    INNER JOIN `class`
                    ON `book`.`classId` = `class`.`classId`
                    INNER JOIN `users`
                    ON `book`.`userId` = `users`.`userId`
                    WHERE `bookId` = ? ";

      $arrParam = [
        $_GET['bookId']
      ];

      //查詢
      $stmt = $pdo->prepare($sql);
      $stmt->execute($arrParam);

      //資料數量大於 0，則列出相關資料
      if ($stmt->rowCount() > 0) {
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";
        // exit();

        switch ($arr[0]['bookStatus']) {
          case "成功":
            $allSelect = "selected";
            $success = "selected";
            break;
          case "取消":
            $sql .= "AND `book`.`bookStatus` = '成功'";
            $cancelled = "selected";
            break;
        }
      ?>
        <tr>
          <td class="border"><?php echo $arr[0]['bookId']; ?></td>
          <td class="border"><?php echo $arr[0]['classId']; ?></td>
          <td class="border"><?php echo $arr[0]['className']; ?></td>
          <td class="border"><?php echo $arr[0]['classDate']; ?></td>
          <td class="border"><?php echo $arr[0]['classTime']; ?></td>
          <td class="border"><?php echo $arr[0]['userId']; ?></td>
          <td class="border"><?php echo $arr[0]['userName']; ?></td>
          <td class="border">
            <select name="bookStatus">
              <option value="成功" <?php echo $success ?>>成功</option>
              <option value="取消" <?php echo $cancelled ?>>取消</option>
            </select>
          </td>
          <td class="border">
            <input type="text" name="bookQty" value="<?php echo $arr[0]['bookQty']; ?>" maxlength="100" />
          </td>
          <td class="border"><?php echo $arr[$i]['created_at']; ?></td>
        </tr>
      <?php
      } else {
      ?>
        <tr>
          <td colspan="7">沒有資料</td>
        </tr>
      <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td class="border" colspan="7"><input class="btn btn-primary" type="submit" name="smb" value="更新"></td>
      </tr>
      </tfoo>
  </table>
  <input type="hidden" name="bookId" value="<?php echo $_GET['bookId']; ?>">
</form>
<?php
require_once('../templates/footer.php');
?>