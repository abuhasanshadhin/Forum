<?php 
    include './includes/header.php';

    use App\classes\Tag;

    $tag = new Tag;
?>

<div class="container-fluid">
    <h1 class="mt-2">Manage Tag</h1>
    
    <div class="row mt-4">
        <div class="col-md-10 offset-md-1">

            <?php
                if (isset($_GET['delete_id'])) {
                    $tag->deleteTag($_GET['delete_id']);
                }
            ?>

            <table class="table table-bordered text-center">

                <tr>
                    <th>Serial</th>
                    <th>Tag Name</th>
                    <th>Action</th>
                </tr>

            <?php
                $tags = $tag->getTags();
                if ($tags->num_rows > 0) {
                    $i = 1;
                    foreach ($tags as $key => $value) {
            ?>

                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td>
                        <a href="edit_tag.php?edit_id=<?php echo $value['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <a href="?delete_id=<?php echo $value['id']; ?>" onclick="return confirm('Are you sure?')" class="btn-danger btn btn-sm"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>

            <?php } } ?>

            </table>
            
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>