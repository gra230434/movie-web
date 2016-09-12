<?php
   session_start();

   // $_SESSION['login_user'] = $rows['user_login']; 使用者帳號
   // $_SESSION['login_disp'] = $rows['user_display']; 使用者全名
   // $_SESSION['login_stat'] = $rows['user_status']; 使用者權限
   // $_SESSION['login_time'] = $rows['user_lasttime']; 使用者最後登入時間

   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
?>
