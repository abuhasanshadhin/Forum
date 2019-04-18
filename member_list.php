<?php
  require './includes/header.php';

  use App\traits\Session;
  use App\classes\Helper;
  use App\classes\Member;

  $member = new Member;
?>

  <div class="container-fluid c-main-content">
    <div class="container mt-100px bg-white">

      <h3 class="text-center">MEMBERS</h3>

      <div class="table-responsive mt-4">
        <table class="table text-center">
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Image</th>
                <th>Join Date</th>
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
                <td>
                  <?php
                    if (!empty($value['image'])) {
                      echo '<img src="'.$value['image'].'" height="64" width="64" class="rounded">';
                    } else {
                      echo '-';
                    }
                  ?>
                </td>
                <td><?php echo Helper::dateModify($value['register_date']); ?></td>
            </tr>

            <?php } } ?>

        </table>
      </div>

    </div>
  </div>
    

<?php
  require './includes/footer.php';
?>