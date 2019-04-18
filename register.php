<?php
  require './includes/header.php';

  use App\classes\Member;
  $member = new Member();
?>

  <div class="container-fluid c-main-content">
    <div class="container mt-100px bg-white">
      <br>
      <h5 class="font-weight-bold">User Registration</h5> <hr>
      <div class="row mt-4">
        <div class="col-md-6">

        <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

            $msg = $member->memberRegistration($_POST);

            if (isset($msg['message'])) {
              echo '<p class="text-success text-center">'.$msg['message'].'</p>';
            }

          }
        ?>
          
          <form action="" method="post">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="first_name">First name</label>
                <input type="text" name="first_name" id="first_name" class="form-control">
                <span class="text-danger"><?php echo (isset($msg['first_name'])) ? $msg['first_name'] : ''; ?></span>
              </div>
              <div class="col-md-6">
                <label for="last_name">Last name</label>
                <input type="text" name="last_name" id="last_name" class="form-control">
                <span class="text-danger"><?php echo (isset($msg['last_name'])) ? $msg['last_name'] : ''; ?></span>
              </div>
            </div>
            <div class="form-group">
              <label for="email">E-Mail Address</label>
              <span id="member-email-exist"></span>
              <input type="email" name="email" id="email" onblur="memberEmailCheck(this.value)" class="form-control">
              <span class="text-danger"><?php echo (isset($msg['email'])) ? $msg['email'] : ''; ?></span>
            </div>
            <div class="form-group row">
              <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <span class="text-danger"><?php echo (isset($msg['password'])) ? $msg['password'] : ''; ?></span>
              </div>
              <div class="form-group col-md-6">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                <span class="text-danger"><?php echo (isset($msg['confirm_password'])) ? $msg['confirm_password'] : ''; ?></span>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" name="register" id="btn-register" class="c-btn-" value="Sign up">
            </div>
          </form>

        </div>
        <div class="col-md-1 border-right"></div>
        <div class="col-md-5">
          <p class="pt-5 ml-4 mt-5">Already have an account?</p>
          <p class="ml-4"><a href="login.php" class="btn p-0 font-weight-bold">Sign In</a></p>
        </div>
      </div>
      <br>
    </div>
    <br>
  </div>
    

<?php require './includes/footer.php'; ?>
