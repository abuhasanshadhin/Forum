<?php 
    include './includes/header.php';

    use App\classes\Category;

    $category = new Category;
?>

<div class="container-fluid">
    <h1 class="mt-2">Manage Category</h1>
    
    <div class="row mt-4">
        <div class="col-md-10 offset-md-1">

            <?php
                if (isset($_GET['delete_id'])) {
                    $category->deleteCategory($_GET['delete_id']);
                }
            ?>

            <table class="table table-bordered text-center">

                <tr>
                    <th>Serial</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>

            <?php
                $categories = $category->getCategories();
                if ($categories->num_rows > 0) {
                    $i = 1;
                    foreach ($categories as $key => $value) {
            ?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td>
                        <a href="edit_category.php?edit_id=<?php echo $value['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <a href="?delete_id=<?php echo $value['id']; ?>" onclick="return confirm('Are you sure?')" class="btn-danger btn btn-sm"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>

            <?php } } ?>

            </table>
            
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>