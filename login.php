<?php
   include("mo-dbcon/connect.php");
   session_start();

   if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
      // username and password sent from form
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT * FROM movie_users WHERE user_login='$username'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows( $result );

      if( $count == 1 ) {

         $rows = mysqli_fetch_array($result);
         if( password_verify( $password ,$rows['user_pass']) ) {

           if ( $rows['user_status'] < 6 ) {

             $_SESSION['login_user'] = $rows['user_login'];
             $_SESSION['login_disp'] = $rows['user_display'];
             header("location: http://movie.technologyofkevin.com/movie.php");

           } else {

             $headerURL = "http://movie.technologyofkevin.com/check.php?N=" . $rows['user_display'];
             header("location: $headerURL");

           }

         } else {
           header("location: http://movie.technologyofkevin.com/index.php?er=1");
         }

       } else {
         $error = 1;
         header("location: http://movie.technologyofkevin.com/index.php?er=2");
      }
   }
?>
