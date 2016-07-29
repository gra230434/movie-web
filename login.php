<?php
   include("DBfolder/connect.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT * FROM movie_users WHERE user_login = '$username'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows( $result );

      if ( $count ==1 ){
        $userrow = mysqli_fetch_assoc($result);
        if ( password_verify( $password ,$userrow['user_pass']) ){
	        $_SESSION['login_user'] = $username;
          header("location: http://movie.technologyofkevin.com/movie.php");
        }else {
          header("location: http://movie.technologyofkevin.com/index.php?er=1");
        }
      }else {
         $error = 1;
         header("location: http://movie.technologyofkevin.com/index.php?er=1");
      }
   }
?>
