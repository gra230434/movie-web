<?php
  require_once( dirname(__FILE__) . '/../mo-dbcon/connect.php' );

  /**
   * check_userstatus : check user status only let status==1
   *
   * @version 1.0.0
   * @author Kevin gra230434@gmail.com
   * @since movie system 1.2
   */
   function check_userstatus( $username ){
     Global $db;
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
     Global $db;
     $sql = "SELECT ID, user_login, user_lasttime, user_status, user_display FROM movie_users";
     if ( $result = mysqli_query($db,$sql) ){
       printf ("<table><thead><tr>
                  <th>ID</th>
                  <th>Full name</th>
                  <th>User name</th>
                  <th>User status</th>
                  <th>Last login</th>
                  </tr></thead>");
       printf ("<tbody>");
       while ( $row = mysqli_fetch_row($result) ){
         $lastdate = empty($row[2])?$row[2]:'No login';
         printf ("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
         $row[0],$row[5],$row[1],$row[3],$lastdate);
       }
       printf ("</tbody>");
       printf ("</table>");
     }
   }
