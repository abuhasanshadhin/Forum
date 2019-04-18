<?php
  use App\classes\Question;

  $question = new Question;
?>

<!-- Popular Questions -->
<div class="row mt-3">
  <ul class="list-group w-100">
    <li class="list-group-item">
      <h5 class="text-secondary"><i class="fa fa-question-circle"></i> Popular Question</h5>
    </li>

    <?php
      if ($question->popular_question()->num_rows > 0) {
        foreach ($question->popular_question() as $key => $value) {
    ?>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="question_description.php?questionId=<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a> 
      <span class="ml-sm-2 badge badge-dark badge-pill"><i class="fa fa-eye"></i> <?php echo $value['popular_count']; ?></span>
    </li>

    <?php } } ?>
    
  </ul>
</div>