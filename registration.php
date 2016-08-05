<?php
   // client close
   include("mo-dbcon/connect.php");
   session_start();

   $errors         = array();      // array to hold validation errors
   $data           = array();      // array to pass back data

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      if (empty($_POST['reusername'])){
        $errors['name'] = 'Name is required.';
      }else {
        $username = mysqli_real_escape_string($db,$_POST['reusername']);
      }

      if (empty($_POST['repassword'])){
        $errors['password'] = 'Password is required.';
      }else {
        $password = mysqli_real_escape_string($db,$_POST['repassword']);
      }

      if (empty($_POST['reusername'])){
        $errors['mail'] = 'Email is required.';
      }else {
        $usermail = mysqli_real_escape_string($db,$_POST['reusermail']);
      }

      $whattime = date("Y-m-d");
      $randnumb = rand(10000,99999);

      $hashpassword = password_hash($password, PASSWORD_DEFAULT);

      $sql = "SELECT user_email FROM movie_users WHERE user_email='$usermail'";
      $check_email = mysqli_query( $db,$sql );
      $count_mail = mysqli_num_rows( $check_email );
      if ($count_mail != 0) { $errors['emaildo'] = 'Someone has used your email. Please try another.'; }

      $sql = "SELECT user_login FROM movie_users WHERE user_login='$username'";
      $check_name = mysqli_query( $db,$sql );
      $count_name = mysqli_num_rows( $check_name );
      if ($count_name != 0) { $errors['namedo'] = 'Someone has used your name. Please try another.'; }

      $namemd5 = md5($username);

      if ( ! empty($errors) ){
        $data['success'] = false;
        $data['errors']  = $errors;
      }else {
        # code...
        $adduser = "INSERT INTO movie_users(user_login, user_pass, user_email, user_registered, user_status, user_display)
                    VALUES ('$username', '$hashpassword', '$usermail', '$whattime', '$randnumb', '$namemd5')";
        $result = mysqli_query($db,$adduser);
        if ( $result ) {
          $data['success'] = true;
          $data['message'] = 'Success!';
        } else {
          $data['success'] = false;
          $data['error'] = 'Something wrong. Q_Q';
        }
      }
    }

    header('Content-Type: application/json');
    echo json_encode($data);
?>
