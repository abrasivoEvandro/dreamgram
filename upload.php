<?php
require_once "./db_connect.php";
require_once "./functions.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Image uploader</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/styles.css">

	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body onload="initialize();">

	<div class="container-upload">
		<div class="row">
			<div id="formParent" class="col-md-10 col-md-offset-3">
				<form id="form" class="form-horizontal" method="POST" action="wall.php" enctype="multipart/form-data">
          <div class="form-group">
            <br>
            <label for="name" class="control-label col-xs-5" style="margin:auto; font-size:18px;">Here you may upload a photo for your viewing pleasure.</label>
            <br>
            <div class="col-xs-11">
              <br>
              <br>
              <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-user fa-fw"></span></span>
                <input type="text" class="form-control" id="name" name="name"
            maxlength="20" size="20" value="" required placeholder="Please enter your name" autofocus>
              </div>
            </div>
          </div>

          <div class="form-group">
              <div class="col-xs-11">
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-header fa-fw"></span></span>
                  <input type="text" class="form-control" id="title" name="title"
              maxlength="20" size="20" value="" required placeholder="Please enter a title" autofocus>
                </div>
              </div>
          </div>

          <div class="form-group">
            <div class="col-xs-11">
              <textarea class="form-control" id="text" name="text" maxlength="140" placeholder="140 characters" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <input type="file" id="upload" name="upload" accept="image/*">
          </div>

          <div class="form-group">
              <h3>Chose a filter!</h3>
              <div class="checkbox-inline">
                  <label for="myNostalgia">Sepia</label>
                  <input type="radio" name="filter" id="myNostalgia" value="myNostalgia" onclick="applyMyNostalgiaFilter();">
              </div>
              <div class="checkbox-inline">
                  <label for="grayscale">Grayscale</label>
                  <input type="radio" name="filter" id="grayscale" value="grayscale" onclick="applyGrayscaleFilter();">
              </div>
              <div class="checkbox-inline">
                  <label for="original">Undo Filter</label>
                  <input type="radio" name="filter" id="lomo" value="lomo" onclick="revertToOriginal();">
              </div>
          </div>

          <input type="submit" value="Upload image to wall!" class="btn btn-success col-md-offset-1">
          <input type="button" id="resetForm" value="Try again" class="btn btn-default">
				</form>
			</div>
		</div>
	</div>

	<!-- JavaScript placed at bottom for faster page loadtimes. -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<script src="js/functions.js"></script>

</body>
</html>
<?php $db->close(); ?>
