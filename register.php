<?php
require_once './db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/freelancer.css">
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
	<div class="container-signup" id="main">
	
<?php

?>
     
   <h1># Sign Up</h1>
     
   <p>Please enter your details below to register.</p>
     
    <form class="form-group" name="registerform" id="registerform">
    <fieldset>
        <label for="username">Username:</label><input class="form-control" type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input class="form-control" type="password" name="password" id="password" /><br />
        <button class="btn btn-default" type="button" name="register" id="registerButton"  />Sign Up</button>
        <script>
          $("#registerButton").click(function() {
                var username = $("#username").val();
                var password = $("#password").val();
                $.ajax({
                  type: "POST",
                  url: './registerScript.php', //script that registers a user. SEPARATED FROM THIS FILE
                  data: { "username": username,
                          "password": password }, // send credentials to script
                  success:function(result){
                    console.log(result);
                      if (result == 1) { // basically a flag, check the script what "result" means
                        $( 'body' ).append( "<div class=\"alert alert-default\">Username already exists!</div>" );
                        $(".alert").fadeOut( 1000, function() {
                        
                        });
                      } else {
                        $( 'body' ).append( "<p style=\"text-align:center;\"><a href=\"index.php\">You many now log in</a></p>" );
                      }
                  }});
          });
        
        </script>
    </fieldset>
    </form>
     
    <?php
?>
 
</div>
</body>
</html>

</div>	
</body>
</html>