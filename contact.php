<?php
  require './includes/header.php';

  use App\traits\Session;
  use App\classes\Member;
  use App\classes\Contact;

  $member = new Member;
  $contact = new Contact;
?>

  <div class="container-fluid c-main-content">
    <div class="container mt-100px bg-white">

      <hr><h3 class="text-center">Contact with 'BD ASK' team</h3><hr>

      <div class="row">
        <div class="col-md-8 offset-md-2 p-3">

          <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-contact'])) {
              $msg = $contact->sendContactMessage($_POST);
            }
          ?>

          <?php echo (isset($msg['success'])) ? $msg['success'] : '' ?>

          <form action="" method="post">
          
            <div class="form-group row">
              <label for="" class="col-md-2 font-weight-bold">Email</label>
              <div class="col-md-10">
                <input type="email" name="email" class="form-control">
                <span class="text-danger"><?php echo (isset($msg['email'])) ? $msg['email'] : '' ?></span>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-md-2 font-weight-bold">Message</label>
              <div class="col-md-10">
                <textarea name="message" id="contact" rows="5" class="ckeditor form-control"></textarea>
                <span class="text-danger"><?php echo (isset($msg['message'])) ? $msg['message'] : '' ?></span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-10 offset-md-2">
                <input type="submit" name="btn-contact" value="Send" class="c-btn-">
              </div>
            </div>

          </form>

        </div>
      </div>


      <div class="bg-warning rounded p-1">
        <div class="bg-white p-3 text-center font-italic">
        We sincerely thank you for staying with BD ASK. You can let us know about any kind of help for BD ASK. We're always ready to help you.
        <p>
          <img src="./images/Thank-You.jpg" class="w-20" alt="">
        </p>
        </div>
      </div>

    </div>
  </div>
    

<?php
  require './includes/footer.php';
?>