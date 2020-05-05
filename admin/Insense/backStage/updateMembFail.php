<?php
require_once('../action/checkAdmin.php'); //引入登入判斷
require_once('../action/db.inc.php'); //引用資料庫連線
require_once('../templates/header.php');
require_once('../templates/leftSideBar.php');
require_once('../templates/rightContainer.php');
?>


<div class="text-center d-flex justify-content-center m-5">
  <div class="spinner-grow text-danger" style="width: 2rem; height: 2rem; margin-top:200px;" role="status">
    <span class="sr-only"></span>
  </div>
  <h4 style="margin-top:200px;">更新失敗</h4>
</div>

<script>
    window.onload = function () {          
      setTimeout(function(){
          alert('更新資料失敗!'); 
      },500);           
    };
    
</script>
<?php
require_once('../templates/footer.php');
header("Refresh: 2; url=../backStage/members.php");
?>