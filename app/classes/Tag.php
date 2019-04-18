<?php
namespace App\classes;

use App\classes\DB;
use App\traits\Validation;

class Tag extends DB
{
  use Validation;

  public function getTags()
  {
    $query = "SELECT * FROM tags ORDER BY id DESC";
    $data = $this->query($query);
    return $data;
  }

  public function getTagByQuestionId($id)
  {
    $query = "SELECT * FROM question_tags WHERE question_id = '$id'";
    $tag_ids = $this->query($query);
    
    $tag_names = [];
    foreach ($tag_ids as $tag_id) {
      $tid = $tag_id['tag_id'];
      $query2 = "SELECT * FROM tags WHERE id = '$tid'";
      $tag_data = $this->query($query2)->fetch_assoc();
      $tag_names[$tag_data['id']] = $tag_data['name'];
    }
    
    return $tag_names;
  }

  public function addTag($data)
  {
    $required = $this->required($data);

    if(!empty($required)) {
      return $required;
    } else {
      $data = (object)$data;
      $query = "INSERT INTO tags(name) VALUES('$data->tag_name')";
      $result = $this->query($query);
      if ($result) {
        return ['tag_name' => '<span class="text-success">Tag added successfully</span>'];
      }
    }
  }

  public function deleteTag($id)
  {
    if (!empty($id)) {
      $query = "DELETE FROM tags WHERE id = '$id'";
      $this->query($query);
    }
  }

  public function getTagById($id)
  {
    if (!empty($id)) {
      $query = "SELECT * FROM tags WHERE id = '$id'";
      $data = $this->query($query)->fetch_assoc();
      return $data;
    }
  }

  public function updateTag($data)
  {
    $required = $this->required($data);

    if(!empty($required)) {
      return $required;
    } else {
      $data = (object)$data;
      $query = "UPDATE tags SET name = '$data->tag_name' WHERE id = '$data->id'";
      $result = $this->query($query);
      if ($result) {
        return ['tag_name' => '<span class="text-success">Tag update successfully</span>'];
      }
    }
  }


}