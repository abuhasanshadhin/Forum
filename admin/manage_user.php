<?php 
    include './includes/header.php';

    use App\classes\Member;

    $member = new Member;
?>

<div class="container-fluid">
    <h1 class="mt-2">Manage User</h1>
    
    <div class="row mt-4">
        <div class="col-md-10 offset-md-1">

<?php
    if (isset($_GET['delete_id'])) {
        $member->deleteMember($_GET['delete_id']);
    }
?>

            <div class="table-responsive">
                <table class="table table-bordered text-center">

                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Join Date</th>
                        <th>Action</th>
                    </tr>

                <?php
                    $members = $member->getMembers();
                    if ($members->num_rows > 0) {
                        $i = 1;
                        foreach ($members as $key => $value) {
                ?>

                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value['first_name'].' '.$value['last_name']; ?></td>
                        <td><img src="<?php echo '.'.$value['image']; ?>" height="50" width="50"></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $value['register_date']; ?></td>
                        <td>
                            <a href="?delete_id=<?php echo $value['id']; ?>" onclick="return confirm('Are you sure?')" class="btn-danger btn btn-sm"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>

                <?php } } ?>

                </table>
            </div>

        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>