<?php
  include("mo-dbcon/connect.php");

  $errors = array();
  $data   = array();

  if ( isset($_GET['V']) ) {
    $movieget = $_GET["V"];
    $videopath = "video/" . $movieget;
    $sql = "SELECT movie_TCname FROM movie_alllist WHERE movie_path='$videopath'";

    if ( $result = mysqli_query( $db,$sql ) ) {
      $count = mysqli_num_rows( $result );

      if ( $count==1 ) {
        if ( $row = mysqli_fetch_array($result) ) {
          $videodir = "./" . $videopath . "/";
          $data['videotitle'] = $row[0];
          // 進資料庫拿取資料
          if ( is_dir($videodir) ) {
            if ( $dh = opendir($videodir) ) {

              while (($file = readdir($dh)) !== false) {
                if ( $file == '.' || $file == '..' || $file == 'over.jpg' ) { continue; }
                else {  $videoname[] = $file; }
              }
              closedir( $dh );
            } else {
              $errors[] = "folder can't open";
            }
          } else {
            $errors[] = "path isn't a folder";
          }
        }
      }

    } else {
      $errors[] = "connect DB error";
    }

    sort($videoname);
    if ( empty($errors) ) {
      $data['success'] = True;
      $data['videodir'] = $videopath;
      $data['videoname'] = $videoname;
    } else {
      $data['success'] = False;
      $data['error'] = $errors;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
  }
?>
