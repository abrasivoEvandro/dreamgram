<?php

require_once "./db_connect.php";

	$imgname = $_POST['name'];

	$query = sprintf("DELETE FROM WALL WHERE IMAGE_NAME='%s'", $imgname);

    $result = $db->query($query);

    if(!$result)
    {
        die('There was an error running the query [' . $db->error . ']');
    }
?>