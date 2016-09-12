<?php
  require( dirname(__FILE__) . '/mo-dbcon/session.php');
  require( dirname(__FILE__) . '/mo-template/template-function.php' );
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <title>絕對低調</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript">
    function loadvideo( videoname ){
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          var returntitle = JSON.parse(xmlhttp.responseText);

          document.getElementById("videolist").innerHTML = buttoncreate(returntitle);
        }
      }
      xmlhttp.open("GET","video.php?V=" + videoname ,true);
      xmlhttp.send();
    }

    function buttoncreate( arr ){
      var returnbutton = "";
      var path = arr[0].replace("./","");
      for (var i = 1; i < arr.length; i++) {
        var before = "<button type='button' onclick=changevideosrc('" + path + arr[i] + "')>";
        var after = "</button>";
        var stringvalue = arr[i].substr(0,2);
        returnbutton = returnbutton.concat(before,stringvalue,after);
      }
      return returnbutton;
    }

    function changevideosrc( newsrc ){
      document.getElementById('animationvideo_source').src = newsrc;
      document.getElementById("animationvideo").load();
    }
    </script>
</head>

<body id="moviebody">
  <div class="sitepage">
    <header class="movieheader">
      <h1>私人動漫天地</h1>
      <p>Welcome <?php echo username($_SESSION['login_user'],$_SESSION['login_disp']); ?></p>
      <p>你上次登入系統是在 <?php echo $_SESSION['login_time'] ?></p>
      <ul class="drop-down-menu">
        <li><a href="logout.php">登出</a></li>
        <li><a href="http://movie.technologyofkevin.com/mo-user/">使用者</a></li>
        <li><a href="http://movie.technologyofkevin.com/mo-admin/">管理者</a></li>
      </ul>
    </header>
    <div class="sidebar">
      <h2>Animation List</h2>
      <?php
        echo ("<div id='animationlist'>");
        $postnum = 1;
        foreach (glob("./video/*") as $videoname){
          $postid = "post" . $postnum;
          $videoname = str_replace("./video/","",$videoname);
          echo ("<h3 id='" . $postid . " videotitle'>");
          echo ( $videoname );
          echo ("</h3>");
          $videoname = str_replace("./video/","",$videoname);
          $videoname = "'" . $videoname . "'";
          echo ('<button type="button" onclick="loadvideo( ' . $videoname . ' )">load video</button>');
          $postnum++;
        }
        echo ("</div><!-- .animationlist -->");
        ?>
      <div id="myDiv"></div>
    </div><!-- .sidebar -->

    <div id="videopart" class="videopart masterbar">
      <video id="animationvideo" controls  width="720" height="480">
        <source id="animationvideo_source" src="big_buck_bunny.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <div id="videolist"></div>
    </div>

  </div>
</body>
</html>
