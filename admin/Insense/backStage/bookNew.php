<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線

//建立種類列表
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
<form name="myForm" enctype="multipart/form-data" method="POST" action="../action/bookAdd.php">
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
          <input type="text" name="userId" value="" maxlength="100" required/>
        </td>
        <td class="border">
          <select name="classChoice">
        <?php for ($i = 0; $i < count($arr); $i++) { ?>
            <option value="<?php echo $arr[$i]['classId']?>"><?php echo $arr[$i]['classId']." - ".$arr[$i]['classDate']." - ".$arr[$i]['className'] ?></option>
        <?php } ?>
          </select>
        </td>
        <td class="border">
          <input type="text" name="bookQty" value="" maxlength="3" required/>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td class="border" colspan="3"><input type="submit" name="smb" value="新增"></td>
      </tr>
    </tfoot>
  </table>
</form>
<?php
require_once('../templates/footer.php');
?>