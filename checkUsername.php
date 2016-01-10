<?php
require_once "./db_connect.php";

$checkusername = $_POST['username'];

$query = "SELECT * FROM `USER` WHERE username = '".$checkusername."'";

$result = $db->query($query);

if($result->num_rows > 0)
{
   echo 1;
}
else
{
	$salt = 'FFSDFLlskdlf£$@£$23lk2l3k4;';
	if(!empty($_POST['username']) && !empty($_POST['password']))
	{
    	$username = $_POST['username'];
  		$stripped_password = $_POST['password'];
  		$password = md5($salt . $stripped_password);
     
    	 $checkusername = "SELECT * FROM `USER` WHERE username = '".$username."'";
     	$result = $db->query($checkusername);
      
   
        	/* create a new entry in the database with the new user's credentials */
        	$insertStmt = "INSERT INTO USER (username, password) VALUES ('$username', '$password')";
       
        	if($db->query($insertStmt))
        	{
           	 	echo "<h1>Success</h1>";
            	echo "<p>Your account was successfully created. Please <a href=\"index.php\">click here to login</a>.</p>";
        	}
        	else
        	{
           		 echo "<h1>Error</h1>";
            	echo "<p>Sorry, your registration failed. Please reload and try again.</p>";   
        	}       
}
	echo 0;
}

?>