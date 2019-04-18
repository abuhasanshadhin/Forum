<?php 
    include './includes/header.php';

    use App\classes\Category;

    $category = new Category;
?>

<div class="container-fluid">
    <h1 class="mt-2">Add Category</h1>
    
    <div class="row mt-100px">
        <div class="col-md-6 offset-md-3">

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-add'])) {
                    $msg = $category->addCategory($_POST);
                }
            ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" name="category_name" id="category_name" class="form-control">
                    <span class="text-danger"><?php echo (isset($msg['category_name'])) ? $msg['category_name'] : '' ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="btn-add" value="Add" class="c-btn-">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>