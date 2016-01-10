<?php

function sanitizeString($_db, $str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return mysqli_real_escape_string($_db, $str);
}


function SavePostToDB($_db, $_user, $_title, $_text, $_time, $_file_name, $_css_filter)
{
    /* Prepared statement, stage 1: prepare query */
    if (!($stmt = $_db->prepare("INSERT INTO WALL(USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME, CSS_FILTER) VALUES (?, ?, ?, ?, ?, ?)")))
    {
        echo "Prepare failed: (" . $_db->errno . ") " . $_db->error;
    }

    /* Prepared statement, stage 2: bind parameters*/
    if (!$stmt->bind_param('ssssss', $_user, $_title, $_text, $_time, $_file_name, $_css_filter))
    {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    /* Prepared statement, stage 3: execute*/
    if (!$stmt->execute())
    {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
}

function getPostcards($_db)
{
    $query = "SELECT USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME, CSS_FILTER FROM WALL ORDER BY TIME_STAMP DESC";

    if(!$result = $_db->query($query))
    {
        die('There was an error running the query [' . $_db->error . ']');
    }

    $output = '';
    while($row = $result->fetch_assoc())
    {
        if (!($_SESSION['Username'] == "sphota")) {
            $output = $output 
        . '<div class="panel panel-default" id="imgpost">
                <div class="panel-heading">"' 
                . $row['STATUS_TITLE']
                . '" posted by ' . $row['USER_USERNAME']
                . '</div><div class="body" style="color: #000000;"><img id="image" src="'
                . /*$server_root .*/ 'img/'
                . $row['IMAGE_NAME']
                . '" '
                . $row['CSS_FILTER']
                . ' width="300px">'
                . $row['STATUS_TEXT']
                . '</div></div>' ;
        }
        else {
         $output = $output 
        . '<div class="panel panel-default id="imgpost">
                <div class="panel-heading">"' 
                . $row['STATUS_TITLE']
                . '" posted by ' . $row['USER_USERNAME']
                . '</div>
                        <div class="body" style="color: #000000;"><img id="image" src="'
                . /*$server_root .*/ 'img/'
                . $row['IMAGE_NAME']
                . '" '
                . $row['CSS_FILTER']
                . ' width="300px">'
                . $row['STATUS_TEXT']
                . '<br>
                    <button type="button" class="btn btn-danger" name="delete" id="deleteButton">Delete Post</button>
                    </div>
                </div>' ;
        }

    }
    return $output;
}


?>
