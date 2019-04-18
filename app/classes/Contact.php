<?php
namespace App\classes;

use App\classes\DB;
use App\traits\Validation;

class Contact extends DB
{
    use Validation;

    public function sendContactMessage($data)
    {
        $required = $this->required($data);

        if (!empty($required)) {
            return $required;
        } else {
            $data = (object)$data;
            $query = "INSERT INTO contacts(email, message) VALUES('$data->email', '$data->message')";
            $result = $this->query($query);

            if ($result) {
                return ['success' => '<p class="text-center text-success">Message send successfully</p>'];
            }
        }
    }
}