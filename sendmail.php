<?php
   include("mo-dbcon/connect.php");
   session_start();

   $errors         = array();      // array to hold validation errors
   $mail           = array();      // array to pass back data

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST['username'])){
      $errors['name'] = 'Name is required.';
    }else {
      $username = mysqli_real_escape_string($db,$_POST['username']);
    }

		if (empty($_POST['usermail'])){
      $errors['mail'] = 'Mail is required.';
    }else {
      $usermail = mysqli_real_escape_string($db,$_POST['usermail']);
    }

		$sql = "SELECT user_status, user_display FROM movie_users WHERE user_login='$username' AND user_email='$usermail'";
		$connect = mysqli_query( $db,$sql );
		$count = mysqli_num_rows( $connect );

		if ( $count == 1 && empty( $errors ) ) {
			$rows     = mysqli_fetch_array($connect);
			$to       = $usermail;
			$subject  = "Movie system check email";
			$headers  = "From: gra09735213@gmail.com \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$txt  = "<html><body>";
			$txt .= "<h1>We need to check this email address is your</h1>";
			$txt .= "<p>Nice to meet you, " . strip_tags($username) . "</p>";
			$txt .= "<p>We need to know the " . strip_tags($usermail) ." is yours.</p>";
			$txt .= "<p>If not, don't care the email or you can resent to us for the trouble!</p>";
			$txt .= "<p>Please click the url to finish the sing in</p><a href='http://movie.technologyofkevin.com/check.php?N=" . strip_tags($rows['user_display']) . "'>click me</a>";
			$txt .= "<p>And keyin your code</p>";
			$txt .= strip_tags($rows['user_status']);
			$txt .= "<p>Thank you!</p>";
			$txt .= "</body></html>";

			if ( mail($to, $subject, $txt, $headers) ){
				$mail['success']= True;
				$mail['message']= "Please check your email.";
			} else {
				$mail['success']= False;
				$mail['message']="Please contact us.";
			}
		}

	}

   header('Content-Type: application/json');
   echo json_encode($mail);
?>
