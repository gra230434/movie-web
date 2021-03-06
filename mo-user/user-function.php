<?php

  require_once( dirname(__FILE__) . '/../mo-dbcon/connect.php' );

  /**
   * check_status : check user status only let status<5
   *
   * @version 1.0.0
   * @author Kevin gra230434@gmail.com
   * @since movie system 1.2
   */
   function check_status( $username ){
     Global $db;
     $sql = "SELECT user_status FROM movie_users WHERE user_login='$username'";
     if ( $result = mysqli_query($db,$sql) ){
       $row = mysqli_fetch_row($result);
       if ( $row[0]<5 ) {
         return 1;
       } else {
         return 0;
       }
     }
   }

  /**
   * user_showuser : show everyone in moviesystem
   *
   * @version 1.0.0
   * @author Kevin gra230434@gmail.com
   * @since movie system 1.2
   */
   function user_showuser( $username ){
     Global $db;
     $sql = "SELECT ID, user_login, user_lasttime, user_display FROM movie_users WHERE user_login=$username";
     if ( $result = mysqli_query($db,$sql) ){
       printf ("<tbody>");
       if ( $row=mysqli_fetch_row($result )) {
         # code...
       }
       printf ("</tbody>");
     }
   }
