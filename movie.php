<?php
  include ("name.php");
  //include ("DBfolder/session.php");
?>

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
        var stringvalue = arr[i].substr(1,2);
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

<body>
  <header>
    <h1>這是私人動漫天地</h1>
    <p>請不要任意洩露密碼，裡面資料會讓我們都死翹翹，謝謝</p>
    <p>Welcome <?php echo $login_session; ?></p>
  </header>
<div class="sidebar">
<h2>Animation List</h2>
<?php
    echo ("<div id='animationlist'>");
    $postnum = 1;
    foreach (glob("./video/*") as $videoname){
        $postid = "post" . $postnum;
        $videoname = str_replace("./video/","",$videoname);
        $videochinesename = $videochangename[$videoname];
        $videoname = "'" . $videoname . "'";
        echo ("<h3 id='" . $postid . " videotitle'>");
        echo ( $videochinesename );
        echo ("</h3>");
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

</body>
