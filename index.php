<?php
   include("DBfolder/connect.php");
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if (mysqli_connect_errno($db)) {
     echo "連結 MySQL 失敗: " . mysqli_connect_error();
   } else {
     # code...
     echo "連接 MySQL 成功<br>";
   }
   session_start();

   if (mysqli_query($db,"SHOW tables")) {
     # code...
     echo "true SHOW tables<br>";
     $result = mysqli_query($db,"SHOW tables");
     $show = mysqli_fetch_row($result);
     print_r( $show );

   }

   if (mysqli_query($db,"EXPLAIN movie_users")) {
     # code...
     echo "true EXPLAIN movie_users";
   }

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT * FROM movie_users WHERE user_login = '$username' and user_pass = '$password'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['user_status'];
      //$error123 = "user name";
      echo "<br>";
      print_r( $result );
      echo "<br>";
      print_r( $row );
      echo "<br>";
      $count = $row[ID];
      echo $count;
      // If result matched $username and $password, table row must be 1 row

      if($count != 0) {
         //session_register("username");
         $_SESSION['login_user'] = $username;
         echo "go to ";
         //header("location: http://movie.technologyofkevin.com/movie.php");
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

<body>
  <header>
    <h1>系統登入</h1>
    <p>為了讓創始者Kevin更加安全，請用帳號密碼登入，如果你沒有帳號密碼，麻煩跟我申請</p>
  </header>

  <div align = "center">
   <div style = "width:300px; border: solid 1px #333333; " align = "left">
      <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

      <div style = "margin:30px">

         <form action = "" method = "post">
            <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
            <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
            <input type = "submit" value = " Submit "/><br />
         </form>

         <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
         <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $sql; ?></div>

      </div>

   </div>

</div>


</body>
