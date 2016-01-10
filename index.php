<?php
require_once './db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/freelancer.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="css/styles.css" rel="stylesheet">

  </head>
  <body>
      <div class="container-login" id="main">
        

<?php
session_start();
$salt = 'FFSDFLlskdlf£$@£$23lk2l3k4;';

/* if there are credentials already stored in the session */
if (isset($_SESSION['LoggedIn']) && isset($_SESSION['Username']))
{
  header("Location: wall.php");  //Redirect browser 
  exit();
  echo "hi";

}
/* if credentials have been posted from the form */
elseif (!empty($_POST['username']) && !empty($_POST['password'])) 
{
  $username = $_POST['username'];
  $stripped_password = $_POST['password'];
  $password = md5($salt . $stripped_password);

  $checklogin = "SELECT * FROM `USER` WHERE `username` = '".$username."' AND `password` = '".$password."'" ;
  $result = $db->query($checklogin);

  if($result->num_rows > 0)
  {
        $_SESSION['Username'] = $username;
        $_SESSION['LoggedIn'] = 1;
         
        echo "<h1>Success</h1>";
        echo "<p>We are now redirecting you to the member area.</p>";
        header("Location: wall.php"); /* Redirect browser */
        exit();
  }
  else
  {
    echo "<h1>Error</h1>";
    echo "<p>Sorry, your credentials were not found in the database. Please <a href=\"index.php\">click here to try again</a>.</p>";
  }
} 
else 
{
  ?>
  <h1># Log In</h1>

   <form class="form-group" method="post" action="index.php" name="loginform" id="loginform">
    <fieldset>
        <label for="username">Username:</label><input class="form-control" type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input class="form-control" type="password" name="password" id="password" /><br />
        <input class="btn btn-default" type="submit" name="login" id="login" value="Log In" />
    </fieldset>
    </form>

    <a href="register.php">Sign Up</a>
  <?php
}
// at the very end
$db->close();
?>

</div>
</body>
</html>

