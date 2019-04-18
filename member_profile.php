<?php
  require './includes/header.php';

  use App\traits\Session;
  use App\classes\Member;

  $member = new Member;
?>

  <div class="container-fluid c-main-content">
    <div class="container mt-100px bg-white">

      <h3 class="text-center">PROFILE</h3><hr>

      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-update'])) {
          $msg = $member->updateMemberInfo($_POST, $_FILES);
        }
      ?>

      <div class="row mt-4">
        <div class="col-md-6 offset-md-3">

        <!-- member info -->
        <?php $memberInfo = $member->getMemberProfileInfo(); ?>

            <p class="text-center">
              <?php
                if (!empty($memberInfo['image'])) {
                  echo '<img src="'.$memberInfo['image'].'" class="w-25 rounded-circle border" alt="">';
                } else {
                  echo '<img src="./images/unknown-man.jpg" class="w-25 rounded-circle" alt="">';
                }
              ?>
            </p>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="" class="font-weight-bold">Add new Image</label>
                    <input type="file" name="image" class="form-control-file">
                    <span class="text-danger"><?php echo (isset($msg['image'])) ? $msg['image'] : '' ?></span>
                </div>

                <div class="form-group">
                    <label for="" class="font-weight-bold">First Name</label>
                    <input type="text" name="first_name" value="<?php echo $memberInfo['first_name']; ?>" class="form-control">
                    <span class="text-danger"><?php echo (isset($msg['first_name'])) ? $msg['first_name'] : '' ?></span>
                </div>

                <div class="form-group">
                    <label for="" class="font-weight-bold">Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $memberInfo['last_name']; ?>" class="form-control">
                    <span class="text-danger"><?php echo (isset($msg['last_name'])) ? $msg['last_name'] : '' ?></span>
                </div>

                <div class="form-group">
                    <label for="" class="font-weight-bold">Email</label>
                    <input type="email" name="email" value="<?php echo $memberInfo['email']; ?>" class="form-control" readonly>
                </div>

                <div class="form-group text-right">
                    <input type="submit" name="btn-update" value="UPDATE" class="c-btn-">
                </div>

            </form>

        </div>
      </div>

    </div>
  </div>
    

<?php
  require './includes/footer.php';
?>