<?php
  // client close
  include("DBfolder/connect.php");
  session_start();

  $errors = array();
  $data   = array();

    if ( empty($_GET['N']) ) {

      // checl length
      if ( strlen($_GET['N']) != 8 ) {
        $errors[notmatch] = "Your URL is worng";
      } else {

        // get url match
        $namemd5 = $_GET['N'];
        if ( !preg_match('/^p[a-z0-9]*$/',$namemd5) ) {
          # code...
          $errors[notmatch] = "Your URL is worng";
        }

      }
      $name = mysqli_real_escape_string($_GET['N']);
    }
