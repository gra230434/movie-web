<?php
   include('config.php');
   session_start();

   $user_name = $_SESSION['login_user'];

   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
?>
