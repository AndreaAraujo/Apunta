<?php
// file: view/language_select_element.php
require_once(__DIR__."/../controller/defaultController.php");
if(!isset($_SESSION)) session_start();

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel ="stylesheet" href="../css/bootstrap.min.css">
		<link rel="shortcut icon" href="../img/favicon.ico">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>
	</head>
	<header>
	<!--<div id="languagechooser">  -->
		<a href="../controller/defaultController.php?controlador=language&accion=change&lang=es">
			<button type="button" class="btn btn-info btn-lg">
			<font color = "navy"><?= i18n("Español") ?></font></button>
		</a>
		<a href="../controller/defaultController.php?controlador=language&accion=change&lang=en">
			<button type="button" class="btn btn-info btn-lg">
			<font color = "navy"><?= i18n("Inglés") ?></font></button>
		</a>
	<!--</div>  -->
</header>
</html>
