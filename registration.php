<?php
   include("DBfolder/connect.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);
      $usermail = mysqli_real_escape_string($db,$_POST['password']);
      $whattime = date("Y-m-d");

      $check_email = $MySQLi_CON->query("SELECT user_email FROM movie_users WHERE user_email='$usermail'");
      $countmail = $check_email->num_rows;

      $check_name = $MySQLi_CON->query("SELECT user_login FROM movie_users WHERE user_login='$username'");
      $countname = $check_name->num_rows;

      if ( $countmail == 0 && $countname == 0 ) {
        $adduser = "INSERT INTO movie_users(user_login, user_pass, user_email, user_registered)
                    VALUES ('$username', '$password', '$usermail', '$whattime')";
        $result = mysqli_query($db,$adduser);
	if ( $result ) {
          $message = "Welcome to movie system!";
          header("location: index.php");
	} else {
	  $message = "Something wrong. Q_Q";
	}
      } else if ( $countmail != 0 ){
	$message = "Someone has used your email. Please try another.";
      } else if ( $countname != 0 ){
        $message = "Someone has used your name. Please try another.";
      }
   }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <title>絕對低調</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="loginpagebody">

  <div class="intoweb">
    <div class="loginbox" align = "left">
      <div class="loginboxtitle"><b>Registration</b></div>

      <div style = "margin:30px">
        <form action = "" method = "post" id="registration_form">
          <p><label for="username">UserName</label></p><input type="text" name="username" required />
          <p><label for="password">Password</label></p><input type="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
	  <p><label for="password">Check Password</label></p><input type="password" name="ckpassword" required />
        </form>

        <div class="loginsubmit">
          <button type="submit" form="login_form" value="Submit" style="left:0;">登入</button>
          <button type="button" style="right:0;">註冊</button>
        </div>

        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div>

    </div>
  </div><!-- intoweb -->

</body>
</html>

