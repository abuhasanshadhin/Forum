<?php
namespace App\classes;

class Helper
{
  public function dateModify($date)
  {
    $time = strtotime($date);
    $new_date = date("D-d-m-Y | h:i:s a", $time);
    return $new_date;
  }


}