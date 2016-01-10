<?php 
require_once './db_connect.php';

	$username = $_POST['uname'];

	$query = "DELETE FROM `USER` WHERE username = '".$username."'";

    $result = $db->query($query);

    if(!$result)
    {
        die('There was an error running the query [' . $db->error . ']');
    }

?>