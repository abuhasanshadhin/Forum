<?php
  require './includes/header.php';

  use App\classes\Question;
  use App\classes\Helper;
  use App\classes\Tag;
  use App\classes\Answer;

  $question = new Question;
  $tag = new Tag;
  $answer = new Answer;
?>

<!-- Search box -->
<?php include './includes/search_box.php'; ?>

<!-- Main Content -->
<div class="c-main-content">
  <div class="container py-3">
    <div class="row">
      <div class="col-md-8">

        <?php
          $per_page = 10;
          if (isset($_GET['p'])) {
            $page = $_GET['p'];
          } else {
            $page = 1;
          }

          $start_from = ($page - 1) * $per_page;
        ?>

        <?php

          if (isset($_GET['search_keyword'])) {
            if (!empty($_GET['search_keyword'])) {
              $questions = $question->getQuestionBySearchKeyword($start_from, $per_page, $_GET['search_keyword']);
            }  
          } elseif (isset($_GET['catId'])) {
            $questions = $question->getQuestionByCategory($start_from, $per_page, $_GET['catId']);
          } elseif (isset($_GET['tagId'])) {
            $questions = $question->getQuestionsByTagId($start_from, $per_page, $_GET['tagId']);
          } elseif (isset($_GET['newest'])) {
            $questions = $question->getQuestionNewest($start_from, $per_page);
          } elseif (isset($_GET['most_viewed'])) {
            $questions = $question->getQuestionMostViewed($start_from, $per_page);
          } elseif (isset($_GET['no_answered'])) {
            $questions = $question->getQuestionNoAnswered($start_from, $per_page);
          } else {
            $questions = $question->getQuestions($start_from, $per_page);
          }
          
          if (!empty($questions)) {
            foreach ($questions as $key => $value) {
        ?>
          <div class="c-content-left border">
            <div class="media">
              <div class="mr-3 c-ans-number"><?php echo $answer->countTotalAnswerByQuestionId($value['id']); ?> <br> <small>Answer</small></div>
              <div class="media-body">
                <h5 class="mt-0">
                  <a href="question_description.php?questionId=<?php echo $value['id']; ?>" class="question-title">
                    <?php echo $value['title']; ?>
                  </a>
                </h5>
                <h6 class="text-secondary"><?php echo Helper::dateModify($value['date_time']); ?></h6>
                <div class="c-tags">
                <?php
                  $tags = $tag->getTagByQuestionId($value['id']);
                  if (!empty($tags)) {
                    foreach ($tags as $tag_key => $tag_v) {
                ?>
                  <a href="index.php?tagId=<?php echo $tag_key; ?>"><?php echo $tag_v; ?></a>
                <?php } } ?>
                </div>
              </div>
            </div>
          </div>
        <?php } } ?>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item <?php echo ($page < 2) ? 'disabled' : '' ?>">
              <a class="page-link" href="?p=<?php echo $page - 1; 
                echo (isset($_GET['catId'])) ? '&catId='.$_GET['catId'] : ''; 
                echo (isset($_GET['tagId'])) ? '&tagId='.$_GET['tagId'] : '';
                echo (isset($_GET['newest'])) ? '&newest' : '';
                echo (isset($_GET['most_viewed'])) ? '&most_viewed' : '';
                echo (isset($_GET['no_answered'])) ? '&no_answered' : '';
                echo (isset($_GET['search_keyword'])) ? '&search_keyword='.$_GET['search_keyword'] : '';  ?>">Previous</a>
            </li>

            <?php
              if (isset($_GET['catId'])) {
                $totalQuestion = $question->countQuestionByCategory($_GET['catId']);
              } elseif (isset($_GET['tagId'])) {
                $totalQuestion = $question->countTotalQuestionByTagId($_GET['tagId']);
              } elseif (isset($_GET['newest'])) {
                $totalQuestion = $question->countTotalQuestionNewest();
              } elseif (isset($_GET['no_answered'])) {
                $totalQuestion = $question->countTotalQuestionNoAnswered();
              } elseif (isset($_GET['search_keyword'])) {
                $totalQuestion = $question->countTotalQuestionBySearchKeyword($_GET['search_keyword']);
              } else {
                $totalQuestion = $question->countTotalQustion();
              }
              
              $totalPage = ceil($totalQuestion / $per_page);

              for ($i=1; $i <= $totalPage; $i++) { 
            ?>

            <li class="page-item">
              <a class="page-link" href="?p=<?php echo $i; 
                echo (isset($_GET['catId'])) ? '&catId='.$_GET['catId'] : ''; 
                echo (isset($_GET['tagId'])) ? '&tagId='.$_GET['tagId'] : '';
                echo (isset($_GET['newest'])) ? '&newest' : '';
                echo (isset($_GET['most_viewed'])) ? '&most_viewed' : '';
                echo (isset($_GET['no_answered'])) ? '&no_answered' : '';
                echo (isset($_GET['search_keyword'])) ? '&search_keyword='.$_GET['search_keyword'] : ''; ?>"><?php echo $i; ?></a>
            </li>

            <?php } ?>

            <li class="page-item <?php echo ($page > ($totalPage - 1)) ? 'disabled' : '' ?>">
              <a class="page-link" href="?p=<?php echo $page + 1; 
                echo (isset($_GET['catId'])) ? '&catId='.$_GET['catId'] : ''; 
                echo (isset($_GET['tagId'])) ? '&tagId='.$_GET['tagId'] : '';
                echo (isset($_GET['newest'])) ? '&newest' : '';
                echo (isset($_GET['most_viewed'])) ? '&most_viewed' : '';
                echo (isset($_GET['no_answered'])) ? '&no_answered' : '';
                echo (isset($_GET['search_keyword'])) ? '&search_keyword='.$_GET['search_keyword'] : ''; ?>">Next</a>
            </li>
          </ul>
        </nav>

      </div>
      <div class="col-md-4">

        <!-- newest, most viewed and unanswered buttons -->
        <?php require './includes/buttons.php'; ?>

        <!-- total questions, total answers, total comments and total members section -->
        <?php require './includes/total_section.php'; ?>

        <!-- ask a question button section -->
        <?php require './includes/ask_a_question_button.php'; ?>

        <!-- bd ask website description section -->
        <?php require './includes/bd_ask_description.php'; ?>

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