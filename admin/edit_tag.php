<?php 
    include './includes/header.php';

    use App\classes\Tag;

    $tag = new Tag;
?>

<div class="container-fluid">
    <h1 class="mt-2">Edit Tag</h1>
    
    <div class="row mt-100px">
        <div class="col-md-6 offset-md-3">

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-update'])) {
                    $msg = $tag->updateTag($_POST);
                }

                if (isset($_GET['edit_id'])) {
                    $data = $tag->getTagById($_GET['edit_id']);
                }
            ?>

            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <div class="form-group">
                    <label for="tag_name">Tag Name</label>
                    <input type="text" name="tag_name" value="<?php echo $data['name'] ?>" id="tag_name" class="form-control">
                    <span class="text-danger"><?php echo (isset($msg['tag_name'])) ? $msg['tag_name'] : '' ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="btn-update" value="Update" class="c-btn-">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>