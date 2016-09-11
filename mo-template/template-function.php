<?php
  require_once( dirname(__FILE__) . '/../mo-dbcon/connect.php' );

  /**
   * user name : check user name
   *
   * @version 1.0.0
   * @author Kevin gra230434@gmail.com
   * @since movie system 1.2
   */
   function username( $loginname, $displayname ){
     if ( $displayname=="" ) {
       return $loginname;
     } else {
       return $displayname;
     }
   }
