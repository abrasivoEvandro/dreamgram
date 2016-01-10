<?php
require_once "./db_connect.php";
require_once "./functions.php";
session_start();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">

      <title>Admin</title>

      <!-- JavaScript placed at bottom for faster page loadtimes. -->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
       <!-- Latest compiled and minified JavaScript -->
      <script src="js/bootstrap.min.js"></script>

      <script src="js/functions.js"></script>

      <!-- Bootstrap core CSS -->

      <link rel="stylesheet" href="css/bootstrap.min.css">
     
      <link rel="stylesheet" href="css/styles.css">
      <link rel="stylesheet" href="css/freelancer.css">
      
    
      <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

      <!-- Custom styles for this template -->
      <link href="css/signin.css" rel="stylesheet">
    </head>

    <body>
    <!-- Navigation -->
    <nav id="navi" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="wall.php">Dreamgram</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="./form.php">Upload Photo</a>
                    </li>
                    <li class="page-scroll">
                        <a href="./admin.php">Admin</a>
                    </li>
                    <li class="page-scroll">
                        <a href="./logout.php">Sign Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
  
  <br>
  <br>
  <br>
  <br>
  <br>
  <h1 id="admin-header">SUPERPOWERS</h1>
  <br>

  <form class="form-group center-block" name="adminform" id="adminform">
    <fieldset>
        <h2>Remove All Posts</h2>
        <button class="btn btn-default center-block" type="button" name="deleteAll" id="deleteAllButton"/>Delete All Posts</button>
        <br>
        <br>
        <h2>Ban User</h2>
        <div class="input-group">
            <span class="input-group-btn">
              <button class="btn btn-danger center-block" type="button" id="banbutton">BAN!</button>
            </span>
            <input type="text" class="form-control center-block" placeholder="Enter username..." id="banfield">
        </div><!-- /input-group -->
         <script>
          $("#deleteAllButton").click(function() {
                $.ajax({
                  url:"deleteAllScript.php", 
                  success:function(data) {
                    console.log(data); 
                  }
              });
          });
          $("#banbutton").click(function() {
                var username = $("#banfield").val();
                $.ajax({
                  url:"banScript.php",  
                  data : { "uname": username },
                  success:function(data) {
                    console.log(data); 
                  }
              });
          });
         </script>
    </fieldset>
    </form>

    </body>
</html>
