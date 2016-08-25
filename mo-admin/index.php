<?php
  include (dirname(__FILE__) . '/../mo-dbcon/session.php' );
  require( dirname(__FILE__) . '/admin-function.php' );

  if ( !check_userstatus( $_SESSION['login_user'] ) ) {
    header ("location: http://movie.technologyofkevin.com/movie.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <title>絕對低調</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
</body>
</html>
