<?php
session_start();

//判斷是否需要登出
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
  //關閉 session
  session_destroy();

  //3 秒後跳頁
  header("Refresh: 0; url=./index.php");
  echo "<script>alert('登出成功')</script>";
  exit();
}
