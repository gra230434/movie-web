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
      $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : 'video.php', // the url where we want to POST
        data        : "V=" + videoname, // our data object
      })
      .done(function(data){
        if ( data.success ) {
          $('#animationtitle').html( data.videotitle );
          $('#videolist').html( buttoncreate( data.videoname, data.videodir ) );
        }
      });
      event.preventDefault();
    };

    function buttoncreate( arr, defpath ){
      var returnbutton = "";
      for (var i = 0; i < arr.length; i++) {
        var stringvalue = arr[i].substr(0,2);
        var before = "<button type='button' value='" + stringvalue + "' onclick=changevideosrc('" + defpath + "/" + arr[i] + "',this)>";
        var after = "</button>";

        returnbutton = returnbutton.concat(before,stringvalue,after);
      }
      return returnbutton;
    }

    function changevideosrc( newsrc, video ){
      var elem = document.getElementById('animationnum');
      if(typeof elem !== 'undefined' && elem !== null) {
        document.getElementById('animationnum').innerHTML = video.value;
      }
      document.getElementById('animationvideo_source').src = newsrc;
      document.getElementById('animationvideo').load();
    }

    </script>
</head>

<body id="moviebody">
  <div class="sitepage">
    <header class="movieheader">
      <h1>私人動漫天地</h1>
      <div class="toright">
        <div class="theptad">
          <p>Welcome <?php echo username($_SESSION['login_user'],$_SESSION['login_disp']); ?></p>
          <div class="clear"></div>
        </div>
        <div class="theptad">
          <p>你上次登入系統是在 <?php echo $_SESSION['login_time'] ?></p>
          <div class="clear"></div>
        </div>
        <div id="navmenu">
          <ul class="drop-down-menu">
            <li><a class="active" href="movie.php">影片</a></li>
            <li><a href="logout.php">登出</a></li>
            <li><a href="/mo-user/">使用者</a></li>
            <li><a href="/mo-admin/">管理者</a></li>
          </ul>
        </div><!-- #navmenu -->
      </div>
      <div class="clear"></div>
    </header>

    <div class="masterbar">
      <div id="videopart" class="videopart">
        <div style="height:76px">
          <h2 id="animationtitle" style="float:left;">測試影片</h2><h2 id="animationnum" style="float:left;margin-left:15px;"></h2>
        </div>
        <video id="animationvideo" controls  width="1280" height="720">
          <source id="animationvideo_source" src="big_buck_bunny.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <div id="videolist"></div>
      </div><!-- videopart -->
    </div><!-- masterbar -->

    <div class="sidebar">
      <h2>Animation List</h2>
      <div id='animationlist'>
      <?php
      video_all_list();
      ?>
      </div><!-- .animationlist -->
    </div><!-- .sidebar -->

  </div>
</body>
</html>
