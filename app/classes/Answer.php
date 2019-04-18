<?php
namespace App\classes;

use App\classes\DB;
use App\traits\Validation;
use App\traits\Session;

class Answer extends DB
{
  use Validation;

  public function give_answer($data)
  {
    $required = $this->required($data, ['question_id']);

    if (!empty($required)) {
      return $required;
    } else {

      Session::init();

      $member_id = Session::get('memberId');

      $data = (object)$data;

      $query = "INSERT INTO answers(question_id, member_id, answer) VALUES('$data->question_id', '$member_id', '$data->answer')";
      $result = $this->query($query);

      if ($result) {
        echo "<script>window.location = 'question_description.php?questionId=".$data->question_id."'</script>";
      }

    }

  }

  public function getAnswersByQuestionId($question_id)
  {
    $query = "SELECT answers.*, members.first_name, members.last_name FROM answers
              INNER JOIN members ON answers.member_id = members.id
              WHERE answers.question_id = '$question_id' ORDER BY answers.id DESC";
    
    $data = $this->query($query);
    
    return $data;
  }

  public function countTotalAnswer()
  {
    $query = "SELECT * FROM answers"; 
    $data = $this->query($query); 
    return $data->num_rows;
  }

  public function countTotalAnswerByQuestionId($question_id)
  {
    $query = "SELECT * FROM answers WHERE question_id = '$question_id'";
    $result = $this->query($query);
    $rows = $result->num_rows;
    return $rows;
  }

  public function give_reply($data)
  {
    $required = $this->required($data, ['question_id', 'answer_id']);

    if (empty($required)) {
      
      Session::init();

      $member_id = Session::get('memberId');

      $data = (object)$data;

      $query = "INSERT INTO answer_replies(member_id, question_id, answer_id, reply)
                VALUES('$member_id', '$data->question_id', '$data->answer_id', '$data->reply')
                ";

      $result = $this->query($query);
          
      if ($result) {
        echo "<script>window.location = 'question_description.php?questionId=".$data->question_id."'</script>";
      }

    }

  }

  public function getRepliesByAnswerId($answer_id)
  {
    $query = "SELECT answer_replies.*, members.first_name, members.last_name FROM answer_replies 
              INNER JOIN members ON answer_replies.member_id = members.id
              WHERE answer_replies.answer_id = '$answer_id' ORDER BY answer_replies.id DESC";
    
    $data = $this->query($query);

    return $data;
  }

  public function countTotalReplies()
  {
    $query = "SELECT * FROM answer_replies";
    $result = $this->query($query);
    return $result->num_rows;
  }



}
