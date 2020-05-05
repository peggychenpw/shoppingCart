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
</style>
<div class="box m-auto text-center">
  <h2 class="mb-4">InSense</h2>
  <form class="logForm p-5" method="POST" action="../action/login.php">
    <div class="form-group">
      <label>
        帳號<input type="text" class="form-control" name="username">
      </label>
    </div>
    <div class="form-group">
      <label>
        密碼<input type="password" class="form-control" name="pwd">
      </label>
    </div>
    <div>
      <input class="w-100 btn btn-outline-secondary mt-3" type="submit" value="登入">
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