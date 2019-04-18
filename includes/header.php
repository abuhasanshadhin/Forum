<?php
  require './vendor/autoload.php';

  use App\traits\Session;
  use App\classes\Member;
  Session::init();
  
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  header("Cache-Control: max-age=2592000");
?>

<?php
  function d($msg) {
    echo '<pre>';
      print_r($msg);
    echo '</pre>';
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>BD ASK</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">

    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="./assets/css/select2.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>
  <body>

    <!-- 
      c = custom css
     -->
    
    <?php
      function active($page_name)
      {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $current_page = basename($path, '.php');
        echo ($current_page == $page_name) ? 'active' : '';
      }
    ?>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white c-floatingNav">
      <div class="container">
        <a class="navbar-brand" href="./index.php"><img src="./images/logo.png" class="logo" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <!-- nav-item-left -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link <?php active('index') ?>" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php active('member_list') ?>" href="member_list.php"><i class="fa fa-users"></i> Members</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php active('contact') ?>" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled <?php active('help') ?>" href="help.php" tabindex="-1" aria-disabled="true">Help</a>
            </li>
          </ul>

          <!-- nav-item-right -->
          <ul class="navbar-nav ml-auto">
            <?php if(empty(Session::get('memberId'))) { ?>
            <li class="nav-item">
              <a class="nav-link <?php active('login') ?>" href="./login.php"><i class="fa fa-key"></i> Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php active('register') ?>" href="./register.php"><i class="fa fa-plus-circle"></i> Register</a>
            </li>
            <?php } else { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                  $member = new Member;
                  $image = $member->getMemberImage();
                  if (!empty($image)) {
                    echo '<img src="'.$image.'" height="40" width="40" class="rounded-circle border">';
                  } else {
                    echo '<span class="text-success">'.Session::get("memberName").'</span>';
                  }
                ?>
                
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="member_profile.php"><i class="fa fa-edit"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <?php
                  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                    Session::destroy();
                    echo '<script>window.location = "login.php"</script>';
                  }
                ?>
                <a class="dropdown-item" href="?action=logout"><i class="fa fa-sign-out"></i> Sign out</a>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>