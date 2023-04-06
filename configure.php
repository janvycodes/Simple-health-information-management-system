<?php
 define('DB_SERVER', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'kbth_db');

$conn = new mysqli('localhost', 'root', '', 'kbth_db');

if($conn->connect_errno){
      echo $mysqli->connect_errno.": ".$mysqli->connect_error;
   }
 ?>