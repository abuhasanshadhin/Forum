<?php 
  include './includes/header.php';

  use App\classes\Question;
  use App\classes\Answer;
  use App\classes\Member;
  use App\classes\Tag;
  use App\classes\Category;

  $question = new Question;
  $answer = new Answer;
  $member = new Member;
  $tag = new Tag;
  $category = new Category;
?>

<div class="container-fluid">
    <h1 class="mt-2">Dashboard</h1>
    
    <div class="row mt-3">
      <div class="col-md-3 mb-4">
        <div class="bg-primary p-3 text-white text-center rounded">
          <h5><?php echo $question->countTotalQustion() ?></h5>
          <h6>Questions</h6>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="bg-info p-3 text-white text-center rounded">
          <h5><?php echo $answer->countTotalAnswer() ?></h5>
          <h6>Answers</h6>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="bg-warning p-3 text-white text-center rounded">
          <h5><?php echo $answer->countTotalReplies() ?></h5>
          <h6>Replies</h6>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="bg-danger p-3 text-white text-center rounded">
          <h5><?php echo $member->countTotalMember() ?></h5>
          <h6>Members</h6>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="bg-dark p-3 text-white text-center rounded">
          <h5><?php echo $tag->getTags()->num_rows ?></h5>
          <h6>Tags</h6>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="bg-secondary p-3 text-white text-center rounded">
          <h5><?php echo $category->getCategories()->num_rows ?></h5>
          <h6>Categories</h6>
        </div>
      </div>
    </div>

</div>

<?php include './includes/footer.php'; ?>