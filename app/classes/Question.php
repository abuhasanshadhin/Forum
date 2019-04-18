<?php
namespace App\classes;

use App\classes\DB;
use App\traits\Validation;
use App\classes\Tag;

class Question extends DB
{
  use Validation;

  public function add_question($data = [])
  {
    $required = $this->required($data);

    if (!empty($required)) {
      return $required;
    } else {
      
      $data = (object)$data;

      $ques_query = "INSERT INTO questions(title, description, category) VALUES('$data->title', '$data->description', '$data->category')";
      $ques_result = $this->query($ques_query);
      if ($ques_result) {

        $last_id = $this->insert_id;

        foreach ($data->tag as $key => $value) {
          $tag_query = "INSERT INTO question_tags(question_id, tag_id) VALUES('$last_id', '$value')";
          $tag_result = $this->query($tag_query);
        }

      }

      if ($ques_result && $tag_result) {
        return ['message'=>'Your question posted successfully'];
      }
      
    }
  }

  public function getQuestionsWithoutLimit()
  {
    $query = "SELECT * FROM questions ORDER BY id DESC";
    $data = $this->query($query);
    return $data;
  }

  public function deleteQuestion($id)
  {
    if (!empty($id)) {
      $query1 = "DELETE FROM questions WHERE id = '$id'";
      $this->query($query1);

      $query2 = "DELETE FROM question_tags WHERE question_id = '$id'";
      $this->query($query2);

      $query3 = "DELETE FROM question_visitors WHERE question_id = '$id'";
      $this->query($query3);

      $query4 = "DELETE FROM answers WHERE question_id = '$id'";
      $this->query($query4);

      $query5 = "DELETE FROM answer_replies WHERE question_id = '$id'";
      $this->query($query5);
    }
  }

  public function getQuestions($start, $limit)
  {
    $query = "SELECT * FROM questions WHERE approve_status = 'yes' ORDER BY id DESC LIMIT $start, $limit";
    $data = $this->query($query);
    return $data;
  }

  public function approveNewQuestion($id)
  {
    if (!empty($id)) {
      $query = "UPDATE questions SET approve_status = 'yes' WHERE id = '$id'";
      $this->query($query);
    }
  }

  public function getQuestionById($id)
  {
    $id = mysqli_real_escape_string($this->db(), intval($id));
    if (!empty($id)) {
      $query = "SELECT * FROM questions WHERE id = '$id'";
      $data = $this->query($query);
      if ($data->num_rows > 0) {
        return $data->fetch_assoc();
      }
    }
  }

  public function countTotalQustion()
  {
    $query = "SELECT * FROM questions";
    $data = $this->query($query);
    return $data->num_rows;
  }

  public function countQuestionByCategory($categoryId)
  {
    $query = "SELECT * FROM questions WHERE category = '$categoryId'";
    $data = $this->query($query);
    return $data->num_rows;
  }

  public function getQuestionByCategory($start, $limit, $categoryId)
  {
    $query = "SELECT * FROM questions WHERE category = '$categoryId' ORDER BY id DESC LIMIT $start, $limit";
    $data = $this->query($query);
    return $data;
  }

  public function popular_question()
  {
    $query = "SELECT * FROM questions ORDER BY popular_count DESC LIMIT 5";
    $data = $this->query($query);
    return $data;
  }

  public function questionPopularIncrese($questionId)
  {
    $browser_id = session_id();

    $check_query = "SELECT * FROM question_visitors WHERE browser_id = '$browser_id' AND question_id = '$questionId'";
    $check_result = $this->query($check_query);

    if ($check_result->num_rows == 0) {

      $query = "INSERT INTO question_visitors(question_id, browser_id) VALUES('$questionId', '$browser_id')";
      $this->query($query);

      $get_popular_query = "SELECT popular_count FROM questions WHERE id = '$questionId'";
      $get_old_popular = $this->query($get_popular_query)->fetch_assoc();

      $increse = $get_old_popular['popular_count'] + 1;

      $update_query = "UPDATE questions SET popular_count = '$increse' WHERE id = '$questionId'";
      $this->query($update_query);

    }

  }

  public function getQuestionsByTagId($start, $limit, $tagId)
  {
    $query = "SELECT * FROM questions WHERE id IN (SELECT question_id FROM question_tags WHERE tag_id='$tagId') LIMIT $start, $limit";
    $questions = $this->query($query);
    return $questions;
  }

  public function countTotalQuestionByTagId($tagId)
  {
    $query = "SELECT * FROM questions WHERE id IN (SELECT question_id FROM question_tags WHERE tag_id='$tagId')";
    $questions = $this->query($query);
    return $questions->num_rows;
  }

  public function getQuestionNewest($start, $limit)
  {
    $minus_days = 60 * 60 * 24 * 2;
    $less_days = time() - $minus_days;

    $from_date = date('Y-m-d h:i:s', time());
    $to_date = date('Y-m-d h:i:s', $less_days);

    $query = "SELECT * FROM questions WHERE date_time <= '$from_date' AND date_time >= '$to_date' LIMIT $start, $limit";
    $data = $this->query($query);
    
    return $data;
  }

  public function countTotalQuestionNewest()
  {
    $minus_days = 60 * 60 * 24 * 2;
    $less_days = time() - $minus_days;

    $from_date = date('Y-m-d h:i:s', time());
    $to_date = date('Y-m-d h:i:s', $less_days);

    $query = "SELECT * FROM questions WHERE date_time <= '$from_date' AND date_time >= '$to_date'";
    $data = $this->query($query);
    
    return $data->num_rows;
  }

  public function getQuestionMostViewed($start, $limit)
  {
    $query = "SELECT * FROM questions ORDER BY popular_count DESC LIMIT $start, $limit";
    $data = $this->query($query);
    return $data;
  }

  public function getQuestionNoAnswered($start, $limit)
  {
    $query = "SELECT questions.* FROM questions LEFT JOIN answers ON questions.id = answers.question_id WHERE answers.question_id IS NULL ORDER BY questions.id DESC LIMIT $start, $limit"; 
    $data = $this->query($query); 
    return $data;
  }

  public function countTotalQuestionNoAnswered()
  {
    $query = "SELECT questions.* FROM questions LEFT JOIN answers ON questions.id = answers.question_id WHERE answers.question_id IS NULL"; 
    $data = $this->query($query); 
    return $data->num_rows;
  }

  public function getQuestionBySearchKeyword($start, $limit, $keyword)
  {
    $query = "SELECT * FROM questions WHERE title LIKE '%$keyword%' OR description LIKE '%$keyword%' ORDER BY id DESC LIMIT $start, $limit";
    $data = $this->query($query);
    return $data;
  }

  public function countTotalQuestionBySearchKeyword($keyword)
  {
    $query = "SELECT * FROM questions WHERE title LIKE '%$keyword%' OR description LIKE '%$keyword%'";
    $data = $this->query($query);
    return $data->num_rows;
  }



}