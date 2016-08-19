<?php
   include("mo-dbcon/connect.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT * FROM movie_users WHERE user_login='$username'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows( $result );

      if($count == 1) {
         $rows = mysqli_fetch_array($result);
         if( password_verify( $password ,$rows['user_pass']) ) {
           if ( !empty($rows['user_display']) ) {
             $_SESSION['login_user'] = $rows['user_display'];
           } else {
             $_SESSION['login_user'] = $rows['user_login'];
           }
           header("location: http://movie.technologyofkevin.com/movie.php");
         } else {
           header("location: http://movie.technologyofkevin.com/index.php?er=1");
         }
       }else {
         $error = 1;
         header("location: http://movie.technologyofkevin.com/index.php?er=2");
      }
   }
?>
