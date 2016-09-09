<?php
   session_start();

   // $_SESSION['login_user'] = $rows['user_login'];
   // $_SESSION['login_disp'] = $rows['user_display'];
   // $_SESSION['login_stat'] = $rows['user_status'];

   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
?>
