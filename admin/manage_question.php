<?php 
    include './includes/header.php';

    use App\classes\Question;

    $question = new Question;
?>

<div class="container-fluid">
    <h1 class="mt-2">Manage Question</h1>
    
    <div class="mt-4">

            <?php
                if (isset($_GET['delete_id'])) {
                    $question->deleteQuestion($_GET['delete_id']);
                }

                if (isset($_GET['approve_id'])) {
                    $question->approveNewQuestion($_GET['approve_id']);
                }
            ?>

            <div class="table-responsive">
                <table class="table table-bordered">

                    <tr>
                        <th>Serial</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    $questions = $question->getQuestionsWithoutLimit();
                    if ($questions->num_rows > 0) {
                        $i = 1;
                        foreach ($questions as $key => $value) {
                    ?>

                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value['title']; ?></td>
                        <td><?php echo $value['description']; ?></td>
                        <td>
                            <?php if ($value['approve_status'] == 'yes') { ?>
                                <a href="" class="disabled btn btn-sm btn-success mb-1">Approved</a>
                            <?php } else { ?>
                                <a href="?approve_id=<?php echo $value['id']; ?>" class="btn btn-sm btn-warning mb-1">Approve</a>
                            <?php } ?>
                            <a href="?delete_id=<?php echo $value['id']; ?>" onclick="return confirm('Are you sure?')" class="btn-danger btn btn-sm"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>

                <?php } } ?>

                </table>
            </div>

    </div>
</div>

<?php include './includes/footer.php'; ?>