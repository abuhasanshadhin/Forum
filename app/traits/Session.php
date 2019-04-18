<?php
namespace App\traits;

trait Session
{
  public function init()
  {
    if (session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }
  }

  public function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public function get($key)
  {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    } else {
      return false;
    }
  }

  public function destroy()
  {
    if (isset($_SESSION) && count($_SESSION) > 0) {
      session_destroy();
    }
  }


}