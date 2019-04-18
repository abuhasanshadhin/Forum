<?php
    require '../vendor/autoload.php';

    use App\classes\Admin;

    $admin = new Admin;

    session_start();
    if (isset($_SESSION['adminId'])) {
        echo "<script>window.location = 'dashboard.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin (Login)</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- Font awesome CSS -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
</head>
<body>
    
    <div class="container">
        <div class="row" style="margin-top: 13%">
            <div class="col-md-4 offset-md-4 border p-3 rounded">

                <h2 class="text-center mb-4">Admin Login</h2>

                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-login'])) {
                        $msg = $admin->login($_POST);
                    }
                ?>

                <form action="" method="post">

                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" class="form-control">
                        <span class="text-danger"><?php echo (isset($msg['username'])) ? $msg['username'] : '' ?></span>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                        <span class="text-danger"><?php echo (isset($msg['password'])) ? $msg['password'] : '' ?></span>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" name="btn-login" class="btn btn-success">
                            <i class="fa fa-sign-in"></i> Login
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>



</body>
</html>