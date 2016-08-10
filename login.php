<?php
/**
 * movie System login.php 設定檔
 *
 * @version 1.0.0
 * @author Kevin gra230434@gmail.com
 * @since 0.1.0 10/08/16
 */

   include("mo-dbcon/connect.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username sent from form
      if (empty($_POST['username'])){
        header("location: http://movie.technologyofkevin.com/index.php?er=3");
      }else {
        $username = mysqli_real_escape_string($db,$_POST['username']);
      }
      // password sent from form
      if (empty($_POST['password'])){
        header("location: http://movie.technologyofkevin.com/index.php?er=4");
      }else {
        $username = mysqli_real_escape_string($db,$_POST['username']);
      }

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
           header("location: http://movie.technologyofkevin.com/index.php?er=2");
         }
      }else {
         header("location: http://movie.technologyofkevin.com/index.php?er=1");
      }
   }
?>
