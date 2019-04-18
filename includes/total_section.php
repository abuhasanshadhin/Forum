<?php
  use App\classes\Question;
  use App\classes\Answer;
  use App\classes\Member;

  $question = new Question;
  $answer = new Answer;
  $member = new Member;
?>

<!-- Total -->
<div class="py-3">
  <div class="row">
    <div class="c-total-questions col-6">
      <?php echo $question->countTotalQustion(); ?> <br> <small>Questions</small>
    </div>
    <div class="c-total-answers col-6">
      <?php echo $answer->countTotalAnswer(); ?> <br> <small>Answers</small>
    </div>
    <div class="c-total-comments col-6">
      <?php echo $answer->countTotalReplies(); ?> <br> <small>Replies</small>
    </div>
    <div class="c-total-members col-6">
      <?php echo $member->countTotalMember(); ?> <br> <small>Members</small>
    </div>
  </div>
</div>