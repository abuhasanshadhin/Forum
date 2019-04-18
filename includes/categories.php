<?php
  use App\classes\Category;
  use App\classes\Question;

  $category = new Category;
  $question = new Question;
?>

<!-- Categories -->
<div class="row mt-3">
  <ul class="list-group w-100">
    <li class="list-group-item">
      <h5 class="text-secondary"><i class="fa fa-list-alt"></i> Category</h5>
    </li>

    <?php
      if ($category->getCategories()->num_rows > 0) {
        foreach ($category->getCategories() as $key => $value) {
    ?>

    <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="index.php?catId=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a>
      <span class="ml-sm-2 badge badge-dark badge-pill">
       <i class="fa fa-question-circle"></i> <?php echo $question->countQuestionByCategory($value['id']); ?>
      </span>
    </li>
    
    <?php } } ?>

  </ul>
</div>