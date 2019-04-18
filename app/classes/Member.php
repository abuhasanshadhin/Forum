<?php
namespace App\classes;

use App\classes\DB;
use App\traits\Validation;
use App\traits\Session;

class Member extends DB
{
  use Validation, Session;

  public function memberRegistration($data = []) 
  {
    $required = $this->required($data);
    $length = $this->check_length($data, ['password' => 3]);

    if (!empty($required)) {
      return $required;
    } else if (!empty($length)) {
      return $length;
    } else if ($this->emailExistenceCheck('members', 'email', $data['email'])) {
      return ['email'=>'Email address already exist'];
    } else {

      $data = (object)$data;

      if ($data->password != $data->confirm_password) {

        return ['confirm_password'=>'Password and confirm password not match'];

      } else {

        $hash_password = password_hash($data->password, PASSWORD_BCRYPT);

        Session::init();
        Session::set('first_name', $data->first_name);
        Session::set('last_name', $data->last_name);
        Session::set('email', $data->email);
        Session::set('hash_password', $hash_password);

        $verify_code = rand(1110, 3000);

        Session::set('verify_code', $verify_code);

        mail($data->email, 'BD ASK (verify)', 'Your verification code : '.$verify_code, 'From: admin@bdask.cf' . "\r\n" .'Reply-To: admin@bdask.cf');

        echo '<script>window.location = "registration_verify.php"</script>';

      }
      
    }
    
  }

  public function registrationConfirm($data)
  {
    $required = $this->required($data);

    if (!empty($required)) {
      return $required;
    } else {

      $data = (object)$data;

      Session::init();

      if (isset($_SESSION['verify_code'])) {

        $verify_code = Session::get('verify_code');

        if ($verify_code == $data->verify_code) {

          $first_name = Session::get('first_name');
          $last_name = Session::get('last_name');
          $email = Session::get('email');
          $hash_password = Session::get('hash_password');

          $query = "INSERT INTO members(first_name, last_name, email, password) VALUES('$first_name', '$last_name', '$email', '$hash_password')"; 
          $result = $this->query($query);
          
          $last_insert_id = $this->insert_id;

          if ($result) {
            Session::init();
            Session::set('memberId', $last_insert_id);
            Session::set('memberName', $first_name.' '.$last_name);
            echo '<script>window.location = "index.php"</script>';
          }
        } else {
          return ['verify_code' => 'Verification code not match'];
        }
      }

    }

  }

  public function memberLogin($data = [])
  {
    $required = $this->required($data);

    if (!empty($required)) {
      return $required;
    } else {
      
      $data = (object)$data;

      if (!$this->emailExistenceCheck('members', 'email', $data->email)) {
        return ['email'=>'Email not exist'];
      } else {

        $query  = "SELECT * FROM members WHERE email = '$data->email'";
        $result = $this->query($query)->fetch_assoc();

        if (password_verify($data->password, $result['password'])) {
          
          $this->init();
          $this->set('memberId', $result['id']);
          $this->set('memberName', $result['first_name'].' '.$result['last_name']);


          $questionId = $this->get('questionId');
          if (!empty($questionId)) {
            echo '<script>window.location = "question_description.php?questionId='.$questionId.'"</script>';
          } else {
            echo '<script>window.location = "index.php"</script>';
          }

        } else {
          return ['password'=>'Password not match'];
        }

      }

    }
    
  }

  public function countTotalMember()
  {
    $query = "SELECT * FROM members";
    $result = $this->query($query);
    return $result->num_rows;
  }

  public function getMembers()
  {
    $query = "SELECT * FROM members";
    $data = $this->query($query);
    return $data;
  }

  public function getMemberProfileInfo()
  {
    Session::init();

    $member_id = Session::get('memberId');

    $query = "SELECT * FROM members WHERE id = '$member_id'";
    $data = $this->query($query)->fetch_assoc();

    return $data;
  }

  public function updateMemberInfo($post, $file)
  {
    Session::init();
    $member_id = Session::get('memberId');

    $required = $this->required($post);

    if (!empty($required)) {
      return $required;
    } else {
      
      $data = (object)$post;

      $image = $file['image']['name'];
      $image_tmp = $file['image']['tmp_name'];
      $image_size = $file['image']['size'];

      if (!empty($image)) {
        
        $div_ext = explode('.', $image);
        $ext = $div_ext[1];
        $unique_name = substr(md5(time()), 0, 10);
        $destination_path = './uploads/'.$div_ext[0].'-'.$unique_name.'.'.$ext;
        
        $permitted_ext = ['jpg', 'jpeg', 'png'];

        if ($image_size > (2 * 1024 * 1024)) {
          return ['image' => 'Image size must be less than 2 MB'];
        } elseif (!in_array($ext, $permitted_ext)) {
          return ['image' => 'Image extention not allowed. You can only upload "jpg" and "jpeg" image.'];
        } elseif (move_uploaded_file($image_tmp, $destination_path)) {

          $select_query = "SELECT image FROM members WHERE id = '$member_id'";
          $select_image = $this->query($select_query)->fetch_assoc();

          if (!empty($select_image['image'])) {
            unlink($select_image['image']);
          }

          $query = "UPDATE members SET first_name = '$data->first_name', last_name = '$data->last_name', image = '$destination_path' WHERE id = '$member_id'";
          $result = $this->query($query);

          echo "<script>window.location = 'member_profile.php'</script>";
        }

      } else {
        $query = "UPDATE members SET first_name = '$data->first_name', last_name = '$data->last_name' WHERE id = '$member_id'";
        $result = $this->query($query);
      }

    }

  }

  public function getMemberImage()
  {
    Session::init();
    $member_id = Session::get('memberId');

    $query = "SELECT image FROM members WHERE id = '$member_id'";
    $image = $this->query($query)->fetch_assoc();

    return $image['image'];
  }

  public function deleteMember($id)
  {
    if (!empty($id)) {
      $query = "DELETE FROM members WHERE id = '$id'";
      $this->query($query);
    }
  }




}