<?php
session_start();
require_once('../action/db.inc.php');
require_once('../templates/header.php');
?>
<style>
  body {
    background-image: url("https://images.unsplash.com/photo-1508717272800-9fff97da7e8f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1351&q=80");
    background-repeat: no-repeat;
    background-size: cover;
  }

  .box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .box h2 {
    color: var(--main-logo-blue);
    font-size: 4rem;
  }

  .logForm {
    border: 2px solid var(--main-light-blue);
    border-radius: 2rem;
  }

  .bordius {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    background: transparent;
    border: 1px solid var(--main-light-blue);
  }

  .borColor {
    background: rgba(240, 240, 240, .3);
    border: 1px solid var(--main-light-blue);
    opacity: .9;
  }

  .btnClick {
    border: 1px solid var(--main-light-blue);
  }

  .btnClick:hover {
    background: var(--main-light-blue);
  }
</style>
<div class="box m-auto text-center">
  <h2 class="mb-4">InSense</h2>
  <form class="logForm p-5" method="POST" action="../action/login.php">
    <div class="form-group mb-4">
      <div class="input-group">
        <div class="input-group-prepend">
          <label class="input-group-text borColor" for="username">帳號</label>
          <input type="text" class="form-control bordius" name="username" id="username">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <label for="pwd" class="input-group-text borColor">密碼</label>
          <input type="password" class="form-control bordius" name="pwd" id="pwd">
        </div>
      </div>
    </div>
    <div>
      <input class="w-100 btn btnClick mt-4" type="submit" value="登入">
    </div>
  </form>
</div>
=
</div> <!-- new container -->
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>