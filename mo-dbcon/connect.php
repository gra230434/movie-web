<?php
/** 導入後端資料庫連結 */
require_once(ABSPATH . 'mo-config.php');

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db)) {
  echo "connect MySQL fail: " . mysqli_connect_error();
}
