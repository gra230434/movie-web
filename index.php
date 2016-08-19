<?php
   include("mo-dbcon/connect.php");
   include("mo-dbcon/error.php");

   session_start();

   $error = "";
   if(isset($_GET['er'])) {
      // username and password sent from form
      $usererror = $_GET['er'];
      $error = $errormessage[$usererror];
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
    <script>
      $(document).ready(function() {
        // process the form
        $('#registration_form').submit(function(event) {

          var username = $('input[name=reusername]').val();
          var usermail = $('input[name=reusermail]').val();
          console.log(username+" , "+usermail);

          // get the form data
          // there are many ways to get this data using jQuery (you can use the class or id also)
          var formData = {
            'reusername' : $('input[name=reusername]').val(),
            'repassword' : $('input[name=repassword]').val(),
            'repassword' : $('input[name=ckpassword]').val(),
            'reusermail' : $('input[name=reusermail]').val()
          };

          // process the form
          $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'registration.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
          })
          // using the done promise callback
          .done(function(data) {
            // here we will handle errors and validation messages
            if ( ! data.success) {
              $('#dialog-error').dialog( "open" );
              $('#dialog-error').html("<p>I'm sorry, but ...</p>");
              // handle errors for name ---------------
              if (data.errors.name) {
                $('#reusername').addClass('has-error'); // add the error class to show red input
                $('#dialog-error').append("<p>" + data.errors.name + "</p>");
              }
              // handle errors for email ---------------
              if (data.errors.password) {
                $('#repassword').addClass('has-error'); // add the error class to show red input
                $('#dialog-error').append("<p>" + data.errors.password + "</p>");
              }
              // handle errors for superhero alias ---------------
              if (data.errors.mail) {
                $('#reusermail').addClass('has-error'); // add the error class to show red input
                $('#dialog-error').append("<p>" + data.errors.mail + "</p>");
              }                // email is not alone
              if (data.errors.emaildo) {
                $('#reusermail').addClass('has-error'); // add the error class to show red input
                $('#dialog-error').append("<p>" + data.errors.emaildo + "</p>");
              }
              // username is not alone
              if (data.errors.namedo) {
                $('#reusername').addClass('has-error'); // add the error class to show red input
                $('#dialog-error').append("<p>" + data.errors.namedo + "</p>");
              }
              // mysql faile
              if (data.error) {
                $('#dialog-error').append('<p>' + data.error + '</p>');
              }

            } else {
              // success get request
              $('#dialog-error').dialog( "open" );
              $('#dialog-error').html('<p>Wellcom to Movie System</p>');
              senttouser( username, usermail );
            }
          });

          // stop the form from submitting the normal way and refreshing the page
          event.preventDefault();
        });

        function senttouser( username , useremail ){
          var mailData = {
            'username' : username,
            'usermail' : useremail
          };
          $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        		url         : 'sendmail.php', // the url where we want to POST
        		data        : mailData, // our data object
        		dataType    : 'json', // what type of data do we expect back from the server
        		encode      : true
        	})
          .done(function(mail){
            if ( ! mail.success ) {
              $('#dialog-error').dialog( "open" );
              $('#dialog-error').html("<p>" + mail.message + "</p>");
            } else {
              $('#dialog-error').dialog( "open" );
              $('#dialog-error').html("<p>" + mail.message + "</p>");
            }
          });
          event.preventDefault();
        };

        $('#dialog-error').dialog({
          title: "Message",
          width: 350,
          autoOpen: false,
          show: {
            effect: "blind",
            duration: 700
          },
          hide: {
            effect: "blind",
            duration: 700
          }
        });//dialog end
      });
    </script>
</head>

<body id="loginpagebody">

  <div id="dialog-error" title="Basic dialog" style="display: none;backgroung-color:white;">
    <p>this is test dialog in firefox</p>
  </div>

  <div class="intoweb" id="intoweb">
    <div class="intobox" align = "left">
      <div id="intoboxtitle" class="intoboxtitle"><b>Login</b></div>

      <div id="loginbox" class="loginbox" style = "margin:30px">
        <form action = "login.php" method = "post" id="login_form">
          <p><label for="username">UserName</label></p><input type="text" name="username" class="logininput" />
          <p><label for="password">Password</label></p><input type="password" name="password" class="logininput" />
        </form>

        <div class="intowebsubmit">
          <button type="submit" form="login_form" value="Submit" style="left:0;">登入</button>
          <button type="button" style="right:0;" id="registrationon">註冊</button>
        </div>

        <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
      </div><!-- .loginbox -->

      <div id="registrationbox" class="registrationbox" style="display:none;margin:30px">
        <form action = "registration.php" method = "post" id="registration_form">
          <div id="input_reusername">
            <p><label for="reusername">UserName</label></p><input id="reusername" type="text" name="reusername" required >
          </div>
          <div id="input_repassword">
            <p><label for="repassword">Password</label></p><input id="repassword" type="password" name="repassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
          </div>
          <div id="input_ckpassword">
            <p><label for="ckpassword">Check Password</label></p><input id="ckpassword" type="password" name="ckpassword" required >
          </div>
          <div id="input_reusermail">
            <p><label for="reusermail">User Email</label></p><input id="reusermail" type="text" name="reusermail" required >
          </div>
        </form>

        <div class="addusersubmit">
          <button type="submit" form="registration_form" value="Submit" style="left:0;">註冊</button>
          <button type="button" style="right:0;" id="loginon">登入</button>
        </div>
      </div><!-- .registrationbox -->

    </div><!-- .intobox -->
  </div><!-- .intoweb -->

  <script>
    var heighch, intoch;
    $('#registrationon').click( function() {
      $('#intoboxtitle').html("<b>Registration</b>");
      $('#loginbox').toggle('200', 'linear');
      intoch = setTimeout(function(){heighhiegh('#intoweb','500')},250);
      heighch = setTimeout(function(){nextintoweb('#registrationbox')},500);
    })
    $('#loginon').click( function() {
      $('#intoboxtitle').html("<b>Login</b>");
      $('#registrationbox').toggle('200', 'linear');
      intoch = setTimeout(function(){heighhiegh('#intoweb','350')},250);
      heighch = setTimeout(function(){nextintoweb('#loginbox')},500);
    })
    function nextintoweb( dividiput ){
	     $(dividiput).toggle('200', 'linear');
    }
    function heighhiegh( dividiput, heighpx ){
	     $(dividiput).css('height',heighpx);
    }
  </script>

</body>
</html>
