<?php
    $movieget = $_GET["V"];

    $videodir = "./video/" . $movieget . "/";
    $videoname[] = "defvideo";

    if ( is_dir($videodir) ) {
      # code...
      if ($dh = opendir($videodir)) {
        # code...
        $videonum = 1;
        while (($file = readdir($dh)) !== false) {
          if ($file=='.'||$file=='..') {
            # code...
            continue;
          } else {
            # code...
            $videoname[] = $file;
          }
        }
        closedir($dh);
      }
    }
    asort($videoname);
    $requence[] = $videodir;
    foreach ($videoname as $value) {
      # code...
      if ($value=="defvideo") {
        continue;
      } else {
        $requence[] = $value;
      }
    }
    header('Content-Type: application/json');
    echo json_encode($requence);
?>
