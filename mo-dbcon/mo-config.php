<?php
/**
 * movie system Mysql 設定檔
 *
 * @version 1.0.0
 * @author Kevin gra230434@gmail.com
 * @since 0.1.0 05/08/16
 */

// ** MySQL 設定 ** //
/** WordPress 的資料庫名稱，請更改 "database_name_here" */
define('DB_DATABASE', 'moviesystem');

/** MySQL 資料庫使用者名稱，請更改 "username_here" */
define('DB_USERNAME', 'XXXXXXXXXXXXXXX');

/** MySQL 資料庫密碼，請更改 "password_here" */
define('DB_PASSWORD', 'XXXXXXXXXXXXXXX');

/** MySQL 主機位址 */
define('DB_SERVER', 'localhost');

/** 建立資料表時預設的文字編碼 */
define('DB_CHARSET', 'utf8mb4');

/** 資料庫對照型態。如果不確定請勿更改。 */
define('DB_COLLATE', 'utf8_unicode_ci');

/** 系統的絕對路徑 */
if ( !defined('ABSPATH') ){
  define('ABSPATH', dirname(__FILE__) . '/');
}
