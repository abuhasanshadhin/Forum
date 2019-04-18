<?php 
    include './includes/header.php';

    use App\classes\Category;

    $category = new Category;
?>

<div class="container-fluid">
    <h1 class="mt-2">Edit Category</h1>
    
    <div class="row mt-100px">
        <div class="col-md-6 offset-md-3">

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-update'])) {
                    $msg = $category->editCategory($_POST);
                }

                if (isset($_GET['edit_id'])) {
                    $data = $category->getCategoryById($_GET['edit_id']);
                }
            ?>

            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" name="category_name" value="<?php echo $data['name'] ?>" id="category_name" class="form-control">
                    <span class="text-danger"><?php echo (isset($msg['category_name'])) ? $msg['category_name'] : '' ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="btn-update" value="Update" class="c-btn-">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>