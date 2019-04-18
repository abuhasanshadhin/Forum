<?php
namespace App\classes;

use App\classes\DB;
use App\traits\Validation;
use App\traits\Session;

class Admin extends DB
{
    use Validation;

    public function login($data)
    {
        $required = $this->required($data, ['btn-login']);
        
        if (!empty($required)) {
            return $required;
        } else {

            $data = (object)$data;

            $password = md5($data->password);
            
            $query = "SELECT * FROM admins WHERE username = '$data->username' AND password ='$password'";
            $result = $this->query($query);

            if ($result->num_rows > 0) {
                
                $result = $result->fetch_assoc();

                Session::init();
                Session::set('adminId', $result['id']);
                Session::set('adminName', $result['name']);

                echo "<script>window.location = 'dashboard.php'</script>";

            } else {
                return ['username'=>'Username or Password was incorrect'];
            }

        }


    }
}