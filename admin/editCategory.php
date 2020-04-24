<?php
require_once('./checkAdmin.php'); //引入登入判斷
require_once('../db.inc.php'); //引用資料庫連線
require_once('./templates/title.php');
 ?>
<!-- <hr />
<h3>商品列表</h3> -->
<div id="viewport">
      <!-- Sidebar -->
      <div id="sidebar">
        <header>
          <a href="#">INSENSE</a>
        </header>
        <ul class="nav">
          <li>
            <a href="#">
              <i class="zmdi zmdi-view-dashboard"></i> Dashboard
            </a>
          </li>
          <li>
            <a href="#">
              <i class="zmdi zmdi-collection-plus"></i> 商品管理
            </a>
          </li>
          <li>
            <a href="#">
              <i class="zmdi zmdi-calendar-alt"></i> 課程預約管理
            </a>
          </li>
          <li>
            <a href="#">
              <i class="zmdi zmdi-money-box"></i> 訂單管理
            </a>
          </li>
          <li>
            <a href="#">
              <i class="zmdi zmdi-account-box"></i> 會員管理
            </a>
          <li>
            <a href="#">
              <i class="zmdi zmdi-store"></i> 廠商後台
            </a>
          </li>
          <li>
            <a href="#">
              <i class="zmdi zmdi-shopping-cart"></i> 購物車優惠卷
            </a>
          </li>
        </ul>
      </div>
      <!-- Content -->
      
      </div>
<div class="wrapper">
  <div id="content">
          <nav class="navbar navbar-default">
            <div class="container-fluid">
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="#"><i class="zmdi zmdi-notifications text-danger"></i>
                  </a>
                </li>
                <li><a href="#">Admin</a></li>
              </ul>
            </div>
          </nav>
          </div>
  <form name="myForm" method="POST" action="updateCategory.php">
      <table class="border">
          <thead>
              <tr>
                  <th class="border">種類名稱</th>
                  <th class="border">新增時間</th>
                  <th class="border">更新時間</th>
              </tr>
          </thead>
          <tbody>
          <?php
          //SQL 敘述
          $sql = "SELECT `categories`.`categoryId`, `categories`.`categoryName`, `categories`.`created_at`, `categories`.`updated_at`
                  FROM  `categories`
                  WHERE `categories`.`categoryId` = ? ";

          $arrParam = [
              (int)$_GET['editCategoryId']
          ];

          //查詢
          $stmt = $pdo->prepare($sql);
          $stmt->execute($arrParam);

          //資料數量大於 0，則列出相關資料
          if($stmt->rowCount() > 0) {
              $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>
              <tr>
                  <td class="border">
                      <input type="text" name="categoryName" value="<?php echo $arr[0]['categoryName']; ?>" maxlength="100" />
                  </td>
                  <td class="border"><?php echo $arr[0]['created_at']; ?></td>
                  <td class="border"><?php echo $arr[0]['updated_at']; ?></td>
              </tr>
          <?php
          } else {
          ?>
              <tr>
                  <td colspan="3">沒有資料</td>
              </tr>
          <?php
          }
          ?>
          </tbody>
          <tfoot>
              <tr>
              <?php if($stmt->rowCount() > 0){ ?>
                  <td class="border" colspan="3"><input type="submit" name="smb" value="更新"></td>
              <?php } ?>
              </tr>
          </tfoo>
      </table>
      <input type="hidden" name="editCategoryId" value="<?php echo (int)$_GET['editCategoryId']; ?>">
  </form>
</div>
<?php require_once('./templates/foot.php'); ?>