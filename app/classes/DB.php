<?php
namespace App\classes;

class DB extends \mysqli
{
  protected $host     = 'localhost';
  protected $user     = 'id7260895_bdask';
  protected $password = 'shadhin98';
  protected $db_name  = 'id7260895_bdask';

  public function __construct()
  {
    parent::__construct($this->host, $this->user, $this->password, $this->db_name);
    $this->set_charset('utf8');
  }

}