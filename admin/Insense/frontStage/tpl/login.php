<span class="ml-3 mr-3"> | </span>
<?php if (!isset($_SESSION["username"])) { ?>
  <form class="form-inline my-2 my-md-0" name="myForm" method="post" action="./login.php">
    <label class="text-dark">帳號:</label>
    <input class="form-control" type="text" name="username" value="" maxlength="50" />
    <label class="text-dark">密碼:</label>
    <input class="form-control" type="password" name="pwd" value="" maxlength="50" />
    <input class="form-control" type="submit" value="登入" />
  </form>
<?php } else { ?>
  <a href="./logout.php?logout=1">登出</a>
<?php } ?>