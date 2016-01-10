<?php
session_start();
// Do not change the following two lines.
$teamURL = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR;
$server_root = dirname($_SERVER['PHP_SELF']);

// You will need to require this file on EVERY php file that uses the database.
// Be sure to use $db->close(); at the end of each php file that includes this!

$dbhost = 'localhost';  // Most likely will not need to be changed
$dbname = 'olevkovskyi2015';   // Needs to be changed to your designated table database name
$dbuser = 'olevkovskyi2015';   // Needs to be changed to reflect your LAMP server credentials
$dbpass = 'mcOCYAkCX4++a'; // Needs to be changed to reflect your LAMP server credentials

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}


$init_query =   "
                CREATE TABLE IF NOT EXISTS `USER`
                (
                    `id` int(8) NOT NULL AUTO_INCREMENT,
                    `username` varchar(255) NOT NULL,
                    `password` varchar(25) NOT NULL,
                    PRIMARY KEY (`id`)
                )
                DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

$init = $db->query($init_query);

if (!$init)
{
    die($db->error);
}
/*
