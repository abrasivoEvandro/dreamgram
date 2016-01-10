<?php

require_once "./db_connect.php";
require_once "./functions.php";
$message = '';
session_start();

$MAX_FILE_SIZE = 2000000; // define maximum legal picture size

if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
  // if session is alive display greeting
  $message .= '<h1 style="text-align:center;">Hello, ' . $_SESSION['Username']. ' </h1>';

  if ($_FILES)
  {
    // get file name and size
    $fname = $_FILES['upload']['name'];
    $ftmp = $_FILES['upload']['tmp_name'];
    $fsize = $_FILES['upload']['size'];

    // parse name for extension
    $fextension = explode('.', $fname);
    $fheader = $fextension[0];
    $fextension = strtolower(end($fextension));

    $fname = $fheader . '_' . $_SERVER['REQUEST_TIME'] . '.' . $fextension;
    $folder_name = 'img';

        if($fsize <= $MAX_FILE_SIZE)
        {
          if(isset($_POST['title']) && isset($_POST['text']))
          {
            $title = sanitizeString($db, $_POST['title']);
            $text = sanitizeString($db, $_POST['text']);

            // add necessary css attributes
            $filter_string = '';

            if ($_POST['filter'] == 'myNostalgia')
            {
              $filter_string = "style='-webkit-filter:sepia(100%);filter:sepia(100%);'";
            }
            elseif ($_POST['filter'] == 'grayscale')
            {
              $filter_string = "style='-webkit-filter:grayscale(100%);filter:grayscale(100%);'";
            }
            elseif ($_POST['filter'] == 'lomo')
            {
              $filter_string = '';
            }
            move_uploaded_file($_FILES['upload']['tmp_name'], $folder_name . DIRECTORY_SEPARATOR . $fname);
            // save to database
            SavePostToDB($db, $_SESSION['Username'], $title, $text, $_SERVER['REQUEST_TIME'], $fname, $filter_string);
          }
        }
        else
        {
          $message = 'The size of the image is too big';
        }
  }
}

else
{
?> <meta http-equiv="refresh" content="0; url=./index.php">  <?php
}
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

      <title>My Wall</title>

      <!-- JavaScript placed at bottom for faster page loadtimes. -->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

      <script src="js/functions.js"></script>

      <!-- Bootstrap core CSS -->

      <link rel="stylesheet" href="css/bootstrap.min.css">
     
      <link rel="stylesheet" href="css/styles.css">
      <link rel="stylesheet" href="css/freelancer.css">
      
    
      <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
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
                        <a href="#" id="admin-link">Admin</a>
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

      <div><?php echo $message; ?></div>


    <br>
    <br>
      <div class="container-wall">
        <?php echo getPostcards($db); ?>
        <script>
          $('body').on('click', '#deleteButton', function() {
            var clickedButton = $(this);
            var name_array = $(this).parent().find('img').attr('src').split('/'); // parent is the div containing button
            // find() basically finds the nearest element that is an img
            // attribute 'src' of img contains the unique image name
            var image_name = name_array[1]; // get the unique image name
            // and here's the real doozy
              $.ajax({
                  type: "POST",
                  url: './deletePost.php', //script that specializes in deleting a post
                  data: { "name": image_name }, //send image name to script
                  success:function(result){
                      clickedButton.parent().parent().hide("slow"); // hide the post from the page
                  }});
          });

          $("#admin-link").click(function () {
            var username;
            $.ajax({
                  type: "GET",
                  url: 'getUser.php', 
                  success:function(result){
                    console.log(result);
                      if (result == "sphota") {
                          window.location = 'admin.php';
                      } else {
                          alert("You are not the admin!")
                      }
                  }});

          });
        
        </script>
      </div>



      <!-- Latest compiled and minified JavaScript -->
      <script src="js/bootstrap.min.js"></script>
      
    </body>
</html>

<?php $db->close(); ?>
