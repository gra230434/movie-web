<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'XXXXXXXXXXXXXXX');
define('DB_PASSWORD', 'XXXXXXXXXXXXXXX');
define('DB_DATABASE', 'moviesystem');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db)) {
  echo "connect MySQL fail: " . mysqli_connect_error();
}

?>
