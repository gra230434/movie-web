<?php
   include("DBfolder/connect.php");

   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT * FROM movie_users WHERE user_login = '$username' and user_pass = '$password'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows( $result );

      // If result matched $username and $password, table row must be 1 row
      if($count == 1) {
         //session_register("username");
         $_SESSION['login_user'] = $username;
         header("location: http://movie.technologyofkevin.com/movie.php");
      }else {
         $error = "Your Login Name or Password is invalid";
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
      <div class="loginboxtitle"><b>Login</b></div>

      <div style = "margin:30px">
        <form action = "" method = "post" id="login_form">
          <p><label for="username">UserName</label></p><input type="text" name="username" class="logininput" />
          <p><label for="password">Password</label></p><input type="password" name="password" class="logininput" />
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
