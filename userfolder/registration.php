<?php
   include("DBfolder/connect.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);
      $usermail = mysqli_real_escape_string($db,$_POST['password']);
      $whattime = date("Y-m-d");

      $check_email = $MySQLi_CON->query("SELECT user_email FROM movie_users WHERE user_email='$usermail'");
      $countmail = $check_email->num_rows;

      $check_name = $MySQLi_CON->query("SELECT user_login FROM movie_users WHERE user_login='$username'");
      $countname = $check_name->num_rows;

      if ( $countmail == 0 && $countname == 0 ) {
        $adduser = "INSERT INTO movie_users(user_login, user_pass, user_email, user_registered)
                    VALUES ('$username', '$password', '$usermail', '$whattime')";
        $result = mysqli_query($db,$adduser);
          if ( $result ) {
            $message = "Welcome to movie system!";
	        } else {
            $message = "Something wrong. Q_Q";
          }
        } else if ( $countmail != 0 ){
          header("location: http://movie.technologyofkevin.com/index.php?er=4");
        } else if ( $countname != 0 ){
          header("location: http://movie.technologyofkevin.com/index.php?er=5");
        }
      }

?>
