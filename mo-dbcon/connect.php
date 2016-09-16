<?php
/** 導入後端資料庫連結 */
require_once( dirname(__FILE__) . '/../mo-config.php' );

Global $db;
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if (mysqli_connect_errno($db)) {
  echo "connect MySQL fail: " . mysqli_connect_error();
  exit();
}

mysqli_query($db, "SET NAMES UTF8");
