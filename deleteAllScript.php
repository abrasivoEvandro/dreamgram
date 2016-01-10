<?php 
require_once './db_connect.php';

	$query = sprintf("DELETE FROM WALL");

    $result = $db->query($query);

    if(!$result)
    {
        die('There was an error running the query [' . $db->error . ']');
    }

?>