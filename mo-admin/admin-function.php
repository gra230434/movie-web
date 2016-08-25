<?php

  require( dirname(__FILE__) . '/../mo-dbcon/mo-config.php' );

  /**
   * check_userstatus : check user status only let status==1
   *
   * @version 1.0.0
   * @author Kevin gra230434@gmail.com
   * @since movie system 1.2
   */
   function check_userstatus( $username ){
     $sql = "SELECT user_status FROM movie_users WHERE user_login='$username'";
     if ( $result = mysqli_query($db,$sql) ){
       $row = mysqli_fetch_row($result);
       if ( $row['user_status']==1 ) {
         return 1;
       } else {
         return 0;
       }
     }
   }

  /**
   * admin_showuser : show everyone in moviesystem
   *
   * @version 1.0.0
   * @author Kevin gra230434@gmail.com
   * @since movie system 1.2
   */
   function admin_showuser(){
     $sql = "SELECT ID, user_login, user_lasttime, user_status, user_display FROM movie_users";
     if ( $result = mysqli_query($db,$sql) ){
       printf ("<tbody><thead><tr>
                  <td>ID</td>
                  <td>Full name</td>
                  <td>User name</td>
                  <td>User status</td>
                  <td>Last login</td>
                  </tr></thead>");
       while ( $row=mysqli_fetch_row($result) ){
         $lastdate = empty($row['user_lasttime'])?$row['user_lasttime']:'No login';
         printf ("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
          $row['ID'],$row['user_display'],$row['user_login'],$row['user_status'],$lastdate);
       }
       printf ("</tbody>");
     }
   }
