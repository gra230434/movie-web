<?php
  include ("name.php");
 ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <title>絕對低調</title>
    <script type="text/javascript">
    function loadvideo( videoname ){
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
        }
      }
      xmlhttp.open("GET","video.php?V=" + videoname ,true);
      xmlhttp.send();
    }
    </script>
</head>

<body>
<div class="sidebar">
<h2>Animation List</h2>
<?php
    echo ("<div id='animationlist'>");
    $postnum = 1;
    foreach (glob("./video/*") as $videoname){
        $postid = "post" . $postnum;
        $videoname = str_replace("./video/","",$videoname);
        $videotitle = $videochangename[$videoname];
        $videoname = "'" . $videoname . "'";
        echo ("<h3 id='" . $postid . " videotitle'>");
        echo ( $videotitle );
        echo ("</h3>");
        echo ('<button type="button" onclick="loadvideo( ' . $videoname . ' )">load video</button>');
        $postnum++;
        }
    echo ("</div><!-- .animationlist -->");
?>
<button type="button" onclick="loadvideo( 321 )">load video</button>
<div id="myDiv"></div>
</div><!-- .sidebar -->

<div class="videopart main">
</div>

</body>
