<?php
  require_once( dirname(__FILE__) . '/../mo-dbcon/connect.php' );

  /**
   * username : check user name
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

   /**
    * video_all_list : printf all video to list
    *
    * @version 1.0.0
    * @author Kevin gra230434@gmail.com
    * @since movie system 1.2
    */
    function video_all_list( $numofvideo = 50 ){
      Global $db;
      $num = 0;
      $sql = "SELECT movieID, movie_TCname, movie_Enname, movie_path FROM movie_alllist LIMIT $numofvideo";
      if ( $result = mysqli_query($db,$sql) ){
        if ( mysqli_num_rows($result)>=1 ) {
          while ( $row = mysqli_fetch_array($result) ){
            $path = ltrim( strstr($row['movie_path'], "/"), "/" );
            $img  = "video/". $path . "/over.jpg";
            $path = "'" . $path . "'";

            echo '<div id="' . $num . '_video" class="videobox" style="background-image: url(' . $img . ')" onclick="loadvideo(' . $path . ')">';
            //echo "<div id='".$num."_video' class'videobox' style='background-image: url('";
            echo "<h3>" . $row['movie_TCname'] . "</h3>";
            echo "</div>";
          }
        } else {
          printf ("Have no any video");
        }
      } else {
        printf ("MySQL error");
      }
    }
