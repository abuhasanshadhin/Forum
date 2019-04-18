<?php
  require './includes/header.php';

  use App\classes\Question;
  use App\classes\Helper;
  use App\classes\Tag;
  use App\classes\Answer;
  use App\traits\Session;

  $question = new Question;
  $tag = new Tag;
  $answer = new Answer;
?>

<?php
  Session::init();
  if (Session::get('questionId') != '') {
    unset($_SESSION['questionId']);
  }
?>

<!-- Search box -->
<?php include './includes/search_box.php'; ?>

<!-- Main Content -->
<div class="c-main-content">
  <div class="container py-3">
    <div class="row">
      <div class="col-md-8">

        <!-- Description -->

        <?php
          if (isset($_GET['questionId'])) {
            
            $question_data = $question->getQuestionById($_GET['questionId']);

            $question->questionPopularIncrese($_GET['questionId']);

          } else {
            echo "<script>window.location = 'index.php'</script>";
          }
        ?>

        <div class="ques-des-sec">

          <h5><i class="fa fa-question-circle"></i> <?php echo $question_data['title']; ?></h5>
          
          <small><i class="fa fa-clock-o"></i> <?php echo Helper::dateModify($question_data['date_time']); ?></small>
          
          <?php echo $question_data['description']; ?>

        </div>

        <!-- description end -->

        
        <!-- Give answer -->

        <?php 
          Session::init();
          if (Session::get('memberId') != '') { 
        ?>

        <div class="bg-white">
          <div class="p-3 mt-2 text-justify">
            
            <?php
              if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-answer'])) {
                $msg = $answer->give_answer($_POST);
              }
            ?>

            <form action="" method="post">
              <h5 class="font-italic">Give your answer</h5>
              <div class="form-group">
                <input type="hidden" name="question_id" value="<?php echo $question_data['id']; ?>">
                <textarea name="answer" id="answer" class="form-control ckeditor"></textarea>
                <span class="text-danger"><?php echo (isset($msg['answer'])) ? $msg['answer'] : '' ?></span>
              </div>
              <div class="form-group text-right">
                <input type="submit" name="btn-answer" value="Answer" class="c-btn-">
              </div>
            </form>

          </div>
        </div>

        <?php } else { ?>

        <div class="bg-white mt-2">
          <div class="p-3 pb-0 text-danger">
            If you want to answer this question then you will <a href="login.php?questionId=<?php echo $_GET['questionId']; ?>">login</a> first.
          </div>
        </div>

        <?php } ?>

        <!-- give answer end -->

        <!-- Answers -->

        <div class="bg-white">
          <div class="p-3 mt-2 text-justify">
            
            <h5 class="font-italic">Answers</h5><hr>

            <?php
              $answers = $answer->getAnswersByQuestionId($question_data['id']);
              if ($answers->num_rows > 0) {
                foreach ($answers as $key => $ans_value) {
            ?>

            <div class="mb-2 show-answer">
              
              <h5><i class="fa fa-user mt-2 mr-1"></i> <?php echo $ans_value['first_name'].' '.$ans_value['last_name']; ?></h5>
              
              <small><i class="fa fa-clock-o mr-1"></i> <?php echo Helper::dateModify($ans_value['date_time']); ?></small>
              
              <?php echo $ans_value['answer']; ?>
              
              <?php 
                Session::init();
                if (Session::get('memberId') != '') { 
              ?>
                <p class="text-right m-0">
                  <button id="<?php echo $ans_value['id'] ?>" class="reply-btn btn" >
                  <i class="fa fa-reply mr-1"></i> Reply</button>
                </p>
              <?php } else { ?>
                <p class="text-right m-0">
                  <button class="reply-btn btn" onclick="alert('If you want to give reply then you will login first !!!')">
                  <i class="fa fa-reply mr-1"></i> Reply</button>
                </p>
              <?php } ?>


              <!-- Give reply -->

            <?php 
              Session::init();
              if (Session::get('memberId') != '') { 
            ?>

              <div class="row mb-1 reply-box" id="reply-box<?php echo $ans_value['id'] ?>">
                <div class="col-md-8 offset-md-2">
                  
                  <?php
                    $ansId = "btn-reply-".$ans_value['id'];
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$ansId])) {
                      $answer->give_reply($_POST);
                    }
                  ?>

                  <form action="" method="post">

                    <input type="hidden" name="question_id" value="<?php echo $question_data['id']; ?>">
                    <input type="hidden" name="answer_id" value="<?php echo $ans_value['id']; ?>">

                    <div class="form-group">
                      <textarea name="reply" rows="3" class="form-control" placeholder="Reply..."></textarea>
                    </div>

                    <div class="form-group text-right">
                      <input type="submit" name="btn-reply-<?php echo $ans_value['id']; ?>" class="c-btn-" value="Reply">
                    </div>

                  </form>  

                </div>
              </div>

            <?php } ?>

              <!-- give reply end -->

              <!-- Replies -->

              <div class="row border-bottom">
                <div class="col-10 offset-1 mb-1">

                    <?php
                      $replies = $answer->getRepliesByAnswerId($ans_value['id']);
                      if ($replies->num_rows > 0) {
                        foreach ($replies as $key => $reply_value) {
                    ?>

                    <div class="border-top">
                      <h6 class="mt-2"><i class="fa fa-user mr-1"></i> <?php echo $reply_value['first_name'].' '.$reply_value['last_name']; ?></h6>
                      <small><i class="fa fa-clock-o mr-1"></i> <?php echo Helper::dateModify($reply_value['date_time']); ?></small>
                      <p class="mt-2"><?php echo $reply_value['reply']; ?></p>
                    </div>

                    <?php } } ?>

                </div>
              </div>

              <!-- replies end -->

            </div>

            <?php } } ?>

          </div>
        </div>

        <!-- answers end -->

      </div>
      <div class="col-md-4">

        <!-- newest, most viewed and unanswered buttons -->
        <?php require './includes/buttons.php'; ?>

        <br>

        <!-- ask a question button section -->
        <?php require './includes/ask_a_question_button.php'; ?>

        <!-- popular questions section -->
        <?php require './includes/popular_question.php'; ?>

        <!-- tags section -->
        <?php require './includes/tags.php'; ?>

        <!-- categories section -->
        <?php require './includes/categories.php'; ?>

      </div>
    </div>
  </div>
</div>

<?php
  require './includes/footer.php';
?>