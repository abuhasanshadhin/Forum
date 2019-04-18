<?php 
    require '../vendor/autoload.php'; 
?>


<?php
  session_start();
  
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
      echo "<script>window.location = 'logout.php'</script>";
    }

  if (!isset($_SESSION['adminId'])) {
    echo "<script>window.location = 'index.php'</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Shadhin">

  <title>BD ASK (Admin Panel)</title>

  <!-- Bootstrap core CSS -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font awesome CSS -->
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">

  <!-- Custom styles for this template -->
  <link href="../assets/css/simple-sidebar.css" rel="stylesheet">

  <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">BD ASK (Admin) </div>
      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action bg-light">
          <i class="fa fa-dashboard"></i> Dashboard
        </a>
        <a href="add_category.php" class="list-group-item list-group-item-action bg-light">
          <i class="fa fa-plus-square"></i> Add Category
        </a>
        <a href="manage_category.php" class="list-group-item list-group-item-action bg-light">
          <i class="fa fa-list-ol"></i> Manage Category
        </a>
        <a href="add_tag.php" class="list-group-item list-group-item-action bg-light">
          <i class="fa fa-plus-square"></i> Add Tag
        </a>
        <a href="manage_tag.php" class="list-group-item list-group-item-action bg-light">
          <i class="fa fa-list-ol"></i> Manage Tag
        </a>
        <a href="manage_question.php" class="list-group-item list-group-item-action bg-light">
          <i class="fa fa-list-ul"></i> Manage Question
        </a>
        <a href="manage_user.php" class="list-group-item list-group-item-action bg-light">
          <i class="fa fa-users"></i> Manage User
        </a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn-secondary rounded" id="menu-toggle">
            <i class="fa fa-bars"></i>
        </button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo '<b>Welcome! </b>'.$_SESSION['adminName'] ?>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?action=logout">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

