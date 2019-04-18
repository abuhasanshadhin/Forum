<?php
namespace App\traits;

use App\classes\DB;

trait Validation
{
  public function db()
  {
    return new DB;
  }

  public function required($data = [], $remove = [])
  {
    $checked = [];
    foreach ($data as $key => $value) {
      if (!is_array($value)) {
        $filter_data = mysqli_real_escape_string($this->db(), $value);
      }
      if (!in_array($key, $remove)) {
        if (empty($filter_data)) {
          $checked[$key] = ucfirst(str_replace('_', ' ', $key).' can not be empty');
        }
      }
    }
    return $checked;
  }

  public function check_length($data = [], $key_length = [])
  {
    $checked = [];
    foreach ($data as $key => $value) {
      foreach ($key_length as $k => $length) {
        if ($key == $k) {
          if (strlen($value) < $length) {
            $checked[$k] = ucfirst(str_replace('_', ' ', $k).' length should be '.$length.' character or upper');
          }
        }
      }
    }
    return $checked;
  }

  public function emailExistenceCheck($table, $email_column, $email)
  {
    $query  = "SELECT * FROM $table WHERE $email_column = '$email'";
    $result = $this->db()->query($query);
    if ($result->num_rows > 0) {
      return true;
    }
  }

}