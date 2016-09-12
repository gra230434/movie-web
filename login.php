<?php
  session_start();
  include("mo-dbcon/connect.php");

  if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    // username and password sent from form
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    $sql = "SELECT user_login, user_display, user_status, user_pass, user_lasttime FROM movie_users WHERE user_login='$username'";
    $result = mysqli_query($db,$sql);
    $count = mysqli_num_rows( $result );

    if( $count == 1 ) {

       $rows = mysqli_fetch_array($result);
       mysqli_free_result($result);
       if( password_verify( $password ,$rows['user_pass']) ) {

         if ( $rows['user_status'] < 6 ) {
           $whattime = date("Y-m-d");;
           $sql = "UPDATE movie_users SET user_lasttime='$whattime' WHERE user_login = '$username'";

           if( mysqli_query($db,$sql) ) {
             $_SESSION['login_user'] = $rows['user_login'];
             $_SESSION['login_disp'] = $rows['user_display'];
             $_SESSION['login_stat'] = $rows['user_status'];
             $_SESSION['login_time'] = $rows['user_lasttime'];
             header("location: http://movie.technologyofkevin.com/movie.php");
           } else {
             header("location: http://movie.technologyofkevin.com/index.php?er=3");
           }

         } else {
           $headerURL = "http://movie.technologyofkevin.com/check.php?N=" . $rows['user_display'];
           header("location: $headerURL");
         }

       } else {
         header("location: http://movie.technologyofkevin.com/index.php?er=2");
       }

     } else {
       $error = 1;
       header("location: http://movie.technologyofkevin.com/index.php?er=1");
    }
  }
?>
