<?php
  require( dirname(__FILE__) . '/../mo-dbcon/session.php' );
  require( dirname(__FILE__) . '/admin-function.php' );

  if ( $_SESSION['login_stat'] != 1 ) {
    header ("location: http://movie.technologyofkevin.com/movie.php");
  }
  require( dirname(__FILE__) . '/../mo-template/template-function.php' );
?>

<?php
  include( dirname(__FILE__) . '/../mo-template/header.php' );
?>
  <div class="sidebar">
    <h2>Animation List</h2>
    <div id="myDiv"></div>
  </div><!-- .sidebar -->
  <div id="videopart" class="videopart masterbar">
    <h1>使用者名單</h1>
    <?php
      admin_showuser();
    ?>
  </div>
<?php
  include( dirname(__FILE__) . '/../mo-template/fooder.php' );
 ?>
