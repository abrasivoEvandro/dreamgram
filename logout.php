<?php
require_once './db_connect.php';
	session_start();
	session_destroy();
	$_SESSION = array();
?>

<meta content="0;index.php" http-equiv="refresh">

