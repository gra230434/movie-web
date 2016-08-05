<?php
  // client close
  include("mo-dbcon/connect.php");
  session_start();

  $errors = array();
  $data   = array();

    if ( empty($_GET['N']) ) {
      $namemd5 = mysqli_real_escape_string($_GET['N']);
      $namemd5 = md5($namemd5);

      $sql = "SELECT * FROM movie_users WHERE user_display = '$namemd5'";
      $connect = mysqli_query( $db,$sql );
  		$count = mysqli_num_rows( $connect );

      if ($count==1) {
        $rows = mysqli_fetch_array($connect);
        $username = $rows['user_login'];

        // post start
        if($_SERVER["REQUEST_METHOD"] == "POST") {
          $check_code = mysqli_real_escape_string($db,$_POST['check_code']);
          $realname = mysqli_real_escape_string($db,$_POST['realname']);
          if ($rows['user_status']==$check_code) {
            $sql = "UPDATE movie_users SET user_status='5' user_display='$realname' WHERE user_display = '$namemd5'";
            if (mysqli_query($db, $sql)) {
              
              header("location: http://movie.technologyofkevin.com/movie.php");
            } else {
              echo "Error updating record: " . mysqli_error($conn);
            }
          }
        } // post end
      }else {
        $errors[notmatch] = 'Your URL is worng';
      }
    } else {
      $errors[notmatch] = 'Your URL is worng';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
    if (!empty($errors)) {
      echo "<meta http-equiv='refresh' content='10;url=http://movie.technologyofkevin.com/'>";
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <title>絕對低調</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
    $(document).ready(function() {
      $('#dialog-error').dialog({
        title: "Message",
        width: 350,
        autoOpen: false,
        show: {
          effect: "blind",
          duration: 700
        },
        hide: {
          effect: "blind",
          duration: 700
        }
      });//dialog end
    });
    </script>
</head>
<body id="loginpagebody">

  <div id="dialog-error" title="Basic dialog" style="display: none;backgroung-color:white;">
    <p>this is test dialog in firefox</p>
  </div>

  <div class="intoweb" id="intoweb">
    <div class="intobox" align = "left">
      <div id="intoboxtitle" class="intoboxtitle"><b>Check Code</b></div>

      <div id="loginbox" class="loginbox" style = "margin:30px">
        <form action = "" method = "post" id="check_form">
          <p>Welcome <?php echo ($username); ?></p>
          <p><label for="check_code">Please enter your Check Code</label></p><input type="txt" name="check_code" class="logininput" />
          <p><label for="check_code">Your real name</label></p><input type="txt" name="realname" class="logininput" />
        </form>

        <div class="intowebsubmit">
          <button type="submit" form="check_form" value="Submit" style="left:0;width:100%">登入</button>
        </div>

        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div><!-- .loginbox -->

    </div><!-- .intobox -->
  </div><!-- .intoweb -->
</body>
</html>
