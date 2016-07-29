<?php
function sendmail($mailaddress, $randomnum) {
     $subject = "Welcome to movie system";
     $txt = "HI new user./n Please enter the number/n" . $randomnum . "/n in page 'http://movie.technologyofkevin.com/checkin.php'";
     $headers = "From: gra09735213@gmail.com";

     mail( $mailaddress, $subject, $txt, $headers);
}
 ?>
