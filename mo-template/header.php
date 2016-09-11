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
  <header>
    <h1>私人動漫天地</h1>
    <p>Welcome <?php echo username($_SESSION['login_user'],$_SESSION['login_disp']); ?> </p>
    <ul class="drop-down-menu">
      <li><a href="http://movie.technologyofkevin.com/logout.php">登出</a></li>
      <li><a href="http://movie.technologyofkevin.com/mo-user/">使用者</a></li>
      <li><a href="http://movie.technologyofkevin.com/mo-admin/">管理者</a></li>
    </ul>
  </header>
