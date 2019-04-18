<?php
  require './includes/header.php';

  use App\traits\Session;
  use App\classes\Member;

  $member = new Member;
?>

<?php

if (isset($_GET['questionId'])) {
  Session::init();
  Session::set('questionId', $_GET['questionId']);
}

?>

  <div class="container-fluid c-main-content">
    <div class="container mt-100px bg-white">
      <br>
      <h5 class="font-weight-bold">Login</h5> <hr>
      <div class="row mt-4">
        <div class="col-md-5">

          <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-login'])) {
              $msg = $member->memberLogin($_POST);
            }
          ?>
          
          <form action="" method="post">
            <div class="form-group">
              <label for="email">E-Mail Address</label>
              <input type="email" name="email" id="email" class="form-control">
              <span class="text-danger"><?php echo (isset($msg['email'])) ? $msg['email'] : ''; ?></span>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control">
              <span class="text-danger"><?php echo (isset($msg['password'])) ? $msg['password'] : ''; ?></span>
            </div>
            <div class="form-group">
              <input type="submit" name="btn-login" value="Sign In" class="c-btn-">
            </div>
          </form>


        </div>
        <div class="col-md-1 border-right"></div>
        <div class="col-md-6">
          <p class="pt-5 ml-4 mt-3">Don't have an account yet?</p>
          <p class="ml-4"><a href="register.php" class="btn font-weight-bold p-0">Sign Up</a></p>
        </div>
      </div>
      <br>
    </div>
    <br>
  </div>
    

<?php
  require './includes/footer.php';
?>