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

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <title>絕對低調</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="loginpagebody">
  <div class="sitepage">

    <div align = "center">
      <div class="loginbox" align = "left">
        <div class="loginboxtitle"><b>Login</b></div>

        <div style = "margin:30px">
          <form action = "" method = "post">
            <label>UserName  :</label><input type = "text" name = "username" class = "logininput"/><br /><br />
            <label>Password  :</label><input type = "password" name = "password" class = "logininput" /><br/><br />
            <input type = "submit" value = " Submit "/><br />
          </form>
          <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
        </div>

      </div>
    </div><!-- center -->

  </div>
</body>
