<?php 
require './includes/header.php'; 

use App\classes\Question;
use App\classes\Tag;
use App\classes\Category;
use App\traits\Session;

Session::init();

if (Session::get('memberId') == '') {
  echo "<script>window.location = 'login.php'</script>";
}

$question = new Question;
$tag      = new Tag;
$category = new Category;
?>

<!-- Main Content -->
<div class="c-main-content">
  <div class="container mt-100px py-3">
    <div class="row">
      <div class="col-md-8">
        <div class="bg-white p-3 mb-4">

          <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-add'])) {
              $msg = $question->add_question($_POST);
              
              if (isset($msg['message'])) {
                echo '<p class="text-success text-center">'.$msg['message'].'</p>';
              }
            }
          ?>


          <form action="" method="post">
            <div class="form-group">
              <label for="title" class="font-italic">Question title</label>
              <input type="text" name="title" id="title" class="form-control font-italic">
              <span class="text-danger"><?php echo (isset($msg['title'])) ? $msg['title'] : '' ?></span>
            </div>
            <div class="form-group">
              <label for="question-description" class="font-italic">Question description</label>
              <textarea name="description" id="question-description" rows="5" class="ckeditor form-control font-italic"></textarea>
              <span class="text-danger"><?php echo (isset($msg['description'])) ? $msg['description'] : '' ?></span>
            </div>
            <div class="form-group">
              <label for="categories" class="font-italic">Question Category</label>
              <select name="category" class="form-control" id="categories">
                <option value="">-- Select Category --</option>
                <?php
                  $categories = $category->getCategories();
                  if (!empty($categories)) {
                    foreach ($categories as $key => $value) {
                ?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php } } ?>
              </select>
              <span class="text-danger"><?php echo (isset($msg['category'])) ? $msg['category'] : '' ?></span>
            </div>
            <div class="form-group">
              <label for="tags" class="font-italic">Question tags</label>
              <select name="tag[]" class="js-example-basic-multiple form-control" id="tags" multiple="multiple">
                <?php
                  $tags = $tag->getTags();
                  if (!empty($tags)) {
                    foreach ($tags as $key => $value) {
                ?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php } } ?>
              </select>
            </div>
            <div class="form-group">
              <input type="submit" name="btn-add" value="POST" class="c-btn-">
            </div>
          </form>
       
        </div>
      </div>
      <div class="col-md-4">

        <!-- tags section -->
        <?php require './includes/tags.php'; ?>

        <!-- categories section -->
        <?php require './includes/categories.php'; ?>

      </div>
    </div>
  </div>
</div>

<?php require './includes/footer.php'; ?>