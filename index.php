<?php
   include("DBfolder/connect.php");
   include("DBfolder/error.php");

   session_start();

   if($_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form
      $usererror = $_GET["er"];
      $error = $errormessage[$usererror];
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
    <div class="intobox" align = "left">
      <div class="intoboxtitle"><b>Login</b></div>

      <div id="loginbox" class="loginbox" style = "margin:30px">
        <form action = "login.php" method = "post" id="login_form">
          <p><label for="username">UserName</label></p><input type="text" name="username" class="logininput" required />
          <p><label for="password">Password</label></p><input type="password" name="password" class="logininput" required />
        </form>

        <div class="intosubmit">
          <button type="submit" form="login_form" value="Submit" style="left:0;">登入</button>
          <button type="button" style="right:0;" id="registrationon">註冊</button>
        </div>

        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div><!-- .loginbox -->

      <div id="registrationbox" class="registrationbox" style="display:none;margin:30px">
        <form action = "registration.php" method = "post" id="registration_form">
          <p><label for="username">UserName</label></p><input type="text" name="registrationusername" required />
          <p><label for="password">Password</label></p><input type="password" name="registrationpassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
          <p><label for="password">Check Password</label></p><input type="password" name="ckpassword" required />
          <p><label for="username">User Email</label></p><input type="text" name="registrationuseremail" required />
        </form>

        <div class="intosubmit">
          <button type="submit" form="login_form" value="Submit" style="left:0;">註冊</button>
          <button type="button" style="right:0;" id="loginon">登入</button>
        </div>

        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div><!-- .registrationbox -->

    </div><!-- .intobox -->
  </div><!-- .intoweb -->

  <script>
    $('#registrationon').click( function() {
        $('#loginbox').toggle('200', 'linear');
        setTimeout(nextintoweb('#registrationbox'),200);
    })
    $('#loginon').click( function() {
        $('#registrationbox').toggle('200', 'linear');
        setTimeout(nextintoweb('#loginbox'),200);
    })
    function nextintoweb( dividiput ){
      $(dividiput).toggle('200', 'linear');
    }
  </script>
</body>
</html>
