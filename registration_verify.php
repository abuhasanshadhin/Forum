<?php
  require './includes/header.php';

  use App\classes\Member;
  $member = new Member();
?>

  <div class="container-fluid c-main-content">
    <div class="container mt-100px bg-white">
      <br>
      <h5 class="font-weight-bold text-center">Email verify for Registration</h5> <hr>
      <div class="row mt-4">
        <div class="col-md-4 offset-md-4">

            <p class="text-justify bg-warning p-2 rounded">
                We have sent a verification code to your email. Please give the code and confirm your registration.
            </p>

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-confirm'])) {
                    $msg = $member->registrationConfirm($_POST);
                }
            ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="verify_code">Verification code</label>
                    <input type="text" name="verify_code" id="verify_code" class="form-control" required>
                    <span class="text-danger"><?php echo (isset($msg['verify_code'])) ? $msg['verify_code'] : '' ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="btn-confirm" value="Confirm" class="c-btn-">
                </div>
            </form>

        </div>
      </div>
      <br>
    </div>
    <br>
  </div>
    

<?php require './includes/footer.php'; ?>
