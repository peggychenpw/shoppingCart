<style>
  .loading-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .loading-content {
    border: transparent;
  }
</style>
<?php
session_start();
require_once('../templates/header.php');

//判斷是否需要登出
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
  //關閉 session
  session_destroy();

  //3 秒後跳頁
  header("Refresh: 1; url=../backStage/log.php");
  // echo "<script>alert('登出成功')</script>";
  // exit();
?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">登出成功</span>
    </button>
  </div>
<?php
}
?>
</div>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>