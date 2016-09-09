<?php

  require( dirname(__FILE__) . '/../mo-dbcon/mo-config.php' );

  /**
   * check_status : check user status only let status<5
   *
   * @version 1.0.0
   * @author Kevin gra230434@gmail.com
   * @since movie system 1.2
   */
   function check_status( $username ){
     $sql = "SELECT user_status FROM movie_users WHERE user_login='$username'";
     if ( $result = mysqli_query($db,$sql) ){
       $row = mysqli_fetch_row($result);
       if ( $row['user_status']<5 ) {
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
     $sql = "SELECT ID, user_login, user_lasttime, user_display FROM movie_users WHERE user_login=$username";
     if ( $result = mysqli_query($db,$sql) ){
       printf ("<tbody>");
       if ( $row=mysqli_fetch_row($result )) {
         # code...
       }
       printf ("</tbody>");
     }
   }
