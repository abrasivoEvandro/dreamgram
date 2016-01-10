<?php
require_once "./db_connect.php";

$checkusername = $_POST['username'];

$query = "SELECT * FROM `USER` WHERE username = '".$checkusername."'";

$result = $db->query($query);

if($result->num_rows > 0)
{
   echo 1; // result
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

          $db->query($insertStmt);
              
  }
	echo 0; // result

}

?>