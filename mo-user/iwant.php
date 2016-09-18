<?php
/**
 *  許願池
 *
 */
 require( dirname(__FILE__) . '/../mo-dbcon/session.php' );
 require( dirname(__FILE__) . '/user-function.php' );

 if ( $_SESSION['login_stat'] < 4 && $_SESSION['login_stat'] > 0 ) {
   if ( isset($_POST['iwant']) ) {

   }
 } else {
   header ("location: http://movie.technologyofkevin.com/movie.php");
 }
 require( dirname(__FILE__) . '/../mo-template/template-function.php' );
 ?>

 <?php
   include( dirname(__FILE__) . '/../mo-template/header.php' );
 ?>

<form action = "" method = "post" id="iwnt_form">
  <div id="iwant_movie_TCname">
    <p><label for="iwant_movie_TCname">影片中文名字</label></p><input id="iwant_movie_TCname" type="text" name="iwant_movie_TCname" required >
  </div>
  <div id="iwant_movie_Enname">
    <p><label for="iwant_movie_Enname">影片英文名字</label></p><input id="iwant_movie_Enname" type="text" name="iwant_movie_Enname" >
  </div>
  <div id="iwant_movie_year">
    <p><label for="iwant_movie_year">影片上映年份</label></p><input id="iwant_movie_year" type="text" name="iwant_movie_year" >
  </div>
  <div id="iwant_movie_season">
    <p><label for="iwant_movie_season">影片季番序號</label></p>
    <input id="iwant_movie_season" type="radio" name="iwant_movie_season" value="1" ><p>第一季</p>
    <input id="iwant_movie_season" type="radio" name="iwant_movie_season" value="2" ><p>第二季</p>
    <input id="iwant_movie_season" type="radio" name="iwant_movie_season" value="3" ><p>第三季</p>
    <input id="iwant_movie_season" type="radio" name="iwant_movie_season" value="4" ><p>第四季</p>
  </div>
  <input id="iwant_login_user" type="hidden" name="iwant_login_user" value="<?php echo $_SESSION['login_user'] ?>" >
  <input id="iwant_login_disp" type="hidden" name="iwant_login_disp" value="<?php echo $_SESSION['login_disp'] ?>" >
</form>


 <?php
   include( dirname(__FILE__) . '/../mo-template/fooder.php' );
  ?>
