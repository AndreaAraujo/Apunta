<?php
require_once("../controller/defaultController.php");


if(!isset($_SESSION)) session_start();

$error = $_GET["error"];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>APUNTA</title>

    <!-- Bootstrap -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

  </head>
  <body>
  <div class="container">
	  <div class="row"><!-- COMIENZO ROW -->
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 20px;">
       <p style="font-size: 15px;color: #f51000; "><?php echo $error; ?></p>
      </div>
    </div><!-- FIN ROW -->
	</div>
  </body>
</html>
