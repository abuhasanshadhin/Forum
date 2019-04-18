<?php
require '../vendor/autoload.php';

use App\classes\DB;
$db = new DB;

if (isset($_POST['member_email'])) {
  $email  = $_POST['member_email'];
  $query  = "SELECT * FROM members WHERE email = '$email'";
  $result = $db->query($query);
  if ($result->num_rows > 0) {
    echo "<p class='text-danger text-center'>Email address already exist !</p>";
  }
}

if (isset($_POST['search_keyword'])) {
  $keyword = $_POST['search_keyword'];
  $query = "SELECT * FROM questions WHERE title LIKE '%$keyword%'";
  $data = $db->query($query);

  $output = '';
  $output .= '<div class="search-suggetion"><ul>';

  foreach ($data as $key => $value) {
    $output .= '<li class="get-search-data">';
    $output .= $value['title'];
    $output .= '</li>';
  }

  $output .= '</ul></div>';

  echo $output;

}