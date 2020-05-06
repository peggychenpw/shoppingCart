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

//引用資料庫連線
require_once('../action/db.inc.php');
require_once('../templates/header.php');
if (isset($_POST['username']) && isset($_POST['pwd'])) {

  //SQL 語法
  $sql = "SELECT `username`, `pwd`, `name`
                    FROM `users`
                    WHERE `username` = ? 
                    AND `pwd` = ? ";

  $arrParam = [
    $_POST['username'],
    sha1($_POST['pwd'])
  ];

  $stmt = $pdo->prepare($sql);
  $stmt->execute($arrParam);

  if ($stmt->rowCount() > 0) {
    //取得資料
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header("Refresh: 1; url=./index.php");
    //3 秒後跳頁

    //將傳送過來的 post 變數資料，放到 session，
    $_SESSION['username'] = $arr[0]['username'];
    $_SESSION['name'] = $arr[0]['name'];

    // echo "<script>alert('登入成功!!!')</script>";
?>
    <div class="loading-icon">
      <button class="d-flex align-items-center loading-content" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span class="mb-1 ml-2">登入成功</span>
      </button>
    </div>
  <?php
  } else {
    header("Refresh: 0; url=./index.php");
    // echo "<script>alert('登入失敗!!!')</script>";
  ?>
    <div class="loading-icon">
      <button class="d-flex align-items-center loading-content" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span class="mb-1 ml-2">登入失敗!!!</span>
      </button>
    </div>
  <?php
  }
} else {
  header("Refresh: 0; url=./index.php");
  // echo "<script>alert('請確實登入!!!')</script>";
  ?>
  <div class="loading-icon">
    <button class="d-flex align-items-center loading-content" type="button" disabled>
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="mb-1 ml-2">請確實登入!!!</span>
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