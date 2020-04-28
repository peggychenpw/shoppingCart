<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
?>

<form method="POST" enctype="multipart/form-data" action="../action/insertClass.php">
  <label for="classImg">課程圖片:</label>
  <input type="file" name="classImg" id="classImg">
  <br>
  <label for="className">課程名稱:</label>
  <input type="text" name="className" id="className">
  <br>
  <label for="classPrice">課程價格:</label>
  <input type="text" name="classPrice" id="classPrice">
  <br>
  <label for="classPeopleLimit">課程人數:</label>
  <input type="text" name="classPeopleLimit" id="classPeopleLimit">
  <br>
  <label for="classCategory">課程類別:</label>
  <select name="classCategory" id="classCategory">
    <option value="c_perfume" selected>香水體驗</option>
    <option value="c_soap">香皂體驗</option>
  </select>
  <br>
  <label for="classDate">課程日期:</label>
  <input type="date" name="classDate" id="classDate">
  <br>
  <label for="classTime">上課時間:</label>
  <select name="classTime" id="classTime">
    <option value="13:00">13:00</option>
    <option value="14:00">14:00</option>
    <option value="15:00">15:00</option>
  </select>
  <br>
  <label for="shopName">廠商名稱</label>
  <select name="shopName" id="shopName">
    <option value="S_001">隨便</option>
    <option value="S_002">青菜</option>
  </select>
  <br>
  <input type="submit" value="送出">
</form>

<?php
require_once('../templates/footer.php'); //引入footer
?>