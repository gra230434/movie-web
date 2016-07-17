<?php
   include("DBfolder/connect.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT * FROM movie_users WHERE user_login = '$username' and user_pass = '$password'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows( $result );

      // If result matched $username and $password, table row must be 1 row
      if($count == 1) {
         //session_register("username");
         $_SESSION['login_user'] = $username;
         header("location: http://movie.technologyofkevin.com/movie.php");
      }else {
         $error = 1;
         header("location: http://movie.technologyofkevin.com/index.php?er=1");
      }
   }
?>
