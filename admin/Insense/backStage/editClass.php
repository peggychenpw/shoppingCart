<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php'); //  1.引入header
require_once('../templates/leftSideBar.php'); // 2. 引入leftSiderBar
require_once('../templates/rightContainer.php'); // 3. 引入rightContainer
?>


<form method="POST" enctype="multipart/form-data" action="../action/insertClass.php">
  <div class="form-row mt-5">
    <!-- <div>
      <label for="classImg">課程圖片:</label>
      <input type="file" name="classImg" id="classImg">
    </div> -->
    <div class="form-group col-md-12 px-5">
      <label for="className">課程名稱:</label>
      <input type="text" class="form-control" name="className" id="className" placeholder="課程名稱">
    </div>
    <div class="form-group col-md-6 px-5">
      <label for="classPrice">課程價格:</label>
      <input type="text" class="form-control" name="classPrice" id="classPrice" placeholder="課程價格">
    </div>
    <div class="form-group col-md-6 px-5">
      <label for="classPeopleLimit">課程人數:</label>
      <input type="text" class="form-control" name="classPeopleLimit" id="classPeopleLimit" placeholder="課程人數">
    </div>
    <div class="form-group col-md-3 px-5">
      <label for="classCategory">課程類別:</label>
      <select name="classCategory" id="classCategory" class="form-control">
        <option value="c_perfume" selected>香水體驗</option>
        <option value="c_soap">香皂體驗</option>
      </select>
    </div>
    <div class="form-group col-md-3 px-5">
      <label for="classDate">課程日期:</label>
      <input type="date" class="form-control" name="classDate" id="classDate">
    </div>
    <div class="form-group col-md-3 px-5">
      <label for="classTime">上課時間:</label>
      <select name="classTime" id="classTime" class="form-control">
        <option value="13:00">13:00</option>
        <option value="14:00">14:00</option>
        <option value="15:00">15:00</option>
        <option value="16:00">16:00</option>
        <option value="17:00">17:00</option>
        <option value="18:00">18:00</option>
        <option value="19:00">19:00</option>
        <option value="20:00">20:00</option>
      </select>
    </div>
    <div class="form-group col-md-3 px-5">
      <label for="shopName">廠商名稱</label>
      <select name="shopName" id="shopName" class="form-control">
        <option value="S_001">ShopA</option>
        <option value="S_002">ShopB</option>
      </select>
    </div>
    <div class="d-flex w-100 px-5 mt-3">
      <a class="btn btn-outline-secondary mr-3" href="./classManagement.php">返回</a>
      <input class="btn btn-outline-info" type="submit" value="送出">
    </div>
  </div>
</form>

<?php
require_once('../templates/footer.php'); //引入footer
?>