<?php
namespace App\classes;

use App\classes\DB;
use App\traits\Validation;

class Category extends DB
{
  use Validation;

  public function getCategories()
  {
    $query = "SELECT * FROM categories ORDER BY id DESC";
    $data = $this->query($query);
    return $data;
  }

  public function addCategory($data)
  {
    $required = $this->required($data);

    if(!empty($required)) {
      return $required;
    } else {
      $data = (object)$data;
      $query = "INSERT INTO categories(name) VALUES('$data->category_name')";
      $result = $this->query($query);
      if ($result) {
        return ['category_name' => '<span class="text-success">Category added successfully</span>'];
      }
    }
  }

  public function deleteCategory($id)
  {
    if (!empty($id)) {
      $query = "DELETE FROM categories WHERE id = '$id'";
      $this->query($query);
    }
  }

  public function getCategoryById($id)
  {
    if (!empty($id)) {
      $query = "SELECT * FROM categories WHERE id = '$id'";
      $data = $this->query($query)->fetch_assoc();
      return $data;
    }
  }

  public function editCategory($data)
  {
    $required = $this->required($data);

    if(!empty($required)) {
      return $required;
    } else {
      $data = (object)$data;
      $query = "UPDATE categories SET name = '$data->category_name' WHERE id = '$data->id'";
      $result = $this->query($query);
      if ($result) {
        return ['category_name' => '<span class="text-success">Category update successfully</span>'];
      }
    }
  }


}