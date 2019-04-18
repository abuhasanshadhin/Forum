<!-- Big footer -->
<div class="container-fluid c-bold-border mt-3">
    <p class="text-center my-5"><img src="./images/logo.png" class="logo" alt=""></p>

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <p class="font-weight-bold">Find Us</p><hr>
          <p><i class="fa fa-map-marker"></i> Senpara parbata, Mirpur-10, Dhaka-1216</p>
          <p><i class="fa fa-phone"></i> +880 1794867982</p>
          <p><i class="fa fa-envelope"></i> shadhinsarker9@gmail.com</p>
        </div>
        <div class="col-md-4">
          <p class="font-weight-bold">BD ASK</p><hr>
          <p><a href="login.php" class="text-dark"><i class="fa fa-sign-in"></i> Sign In</a></p>
          <p><a href="register.php"  class="text-dark"><i class="fa fa-plus-circle"></i> Member Registration</a></p>
          <p><a href="index.php"  class="text-dark"><i class="fa fa-question-circle"></i> Questions</a></p>
        </div>
        <div class="col-md-4">
          <p class="font-weight-bold">Social Media</p><hr>
          <p>
            <i class="fa fa-facebook"></i> 
            <a href="https://www.fb.com/abuhasanshadhin" class="text-dark" target="_blank">www.fb.com</a>
          </p>
          <p><i class="fa fa-twitter"></i> www.twitter.com</p>
          <p><i class="fa fa-linkedin"></i> www.linkedin.com</p>
        </div>
      </div>
    </div>

  </div>

  <!-- Footer -->
  <div class="container-fluid bg-dark">
    <p class="text-center py-4 text-white m-0">Copyright &copy; Abu Hasan Shadhin - 2019</p>
  </div>

  <div class="scroll-Top">
    <i class="fa fa-arrow-up"></i>
  </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="./assets/js/jquery-3.3.1.js"></script>

    <!-- Ck Editor -->
    <script src="//cdn.ckeditor.com/4.11.2/basic/ckeditor.js"></script>
    <script>
      CKEDITOR.replace( 'question-description' );
      CKEDITOR.replace( 'answer' );
      CKEDITOR.replace( 'contact' );
    </script>

    <!-- Select 2 JS -->
    <script src="./assets/js/select2.min.js"></script>

    <!-- Custom JS -->
    <script>
      // Select 2 ---
      $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
      });

      // scroll to top ---
      $(".scroll-Top").hide();
      $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
          $(".scroll-Top").fadeIn();
        } else {
          $(".scroll-Top").fadeOut();
        }
      });

      $(".scroll-Top").click(function() {
        $("html, body").animate({scrollTop: 0}, 800);
      });


      // member registration email check ---
      function memberEmailCheck(email) {
        $.ajax({
          url: './includes/ajax_action.php',
          method: 'POST',
          data: {member_email:email},
          success: function(response) {
            $('#member-email-exist').html(response);
          }
        });
      }


      // reply box show hide ---
      $('.reply-box').hide();
      $('.reply-btn').click(function() {
        var id = $(this).attr('id');
        $('#reply-box' + id).slideToggle();
      });


      // search data in bd-ask
      $("#keyword").keyup(function() {
        var keyword = $(this).val();
        if (keyword != '') {
          $.ajax({
            url: './includes/ajax_action.php',
            method: 'POST',
            data: {search_keyword:keyword},
            success: function(response) {
              $('#show-search-results').show().html(response);
            }
          });
        } else {
          $('#show-search-results').fadeOut();
        }
      });

      $(document).on('click', '.get-search-data', function() {
        $("#keyword").val($(this).text());
        $('#show-search-results').fadeOut();
      });

    </script>

  </body>
</html>