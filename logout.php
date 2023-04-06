<?php
session_start();
//destroy session
session_destroy();
//unset cookies
setcookie('user_login', '', 0, "/");
unset($_SESSION['attempt']);
header("Location: index.php");
?>