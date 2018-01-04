<?php

require_once(__DIR__."/../controller/defaultController.php");
include(__DIR__."/../views/language_select_element.php");

if(!isset($_SESSION)) session_start();

?>

<!DOCTYPE html>

<html>

	<head>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel ="stylesheet" href="../css/bootstrap.min.css">
    <link rel ="stylesheet" href="../css/registro.css">
    <link rel="shortcut icon" href="favicon.ico">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
	</head>


	<body >
    <div class="container" id="login">
      <center>

				<form action="../controller/defaultController.php?controlador=usuario&amp;accion=registro" method="post" class ="formulario" role = "form">

					<label for = "logUsuario"><?= i18n("Nombre de usuario")?>:</label>
					<input type="text" name="logUsuario">

					<label for = "emailUsuario"><?= i18n("Correo electrónico")?>:</label>
          <input type="text" name="emailUsuario">

					<label for = "conUsuario"><?= i18n("Contraseña")?>:</label>
    	    <input type="password" name="conUsuario"  maxlength="8">

					<label for = "confirmar"><?= i18n("Confirmar contraseña")?>:</label>
          <input type="password" name="confirmar" maxlength="8"><br><br>

					<input type="submit" name="enviar" value = <?= i18n("Registrar")?>>

					<a href="../index.php" id="reg"><?= i18n("Atrás")?></a>
        </form>
      </center>
    </div>
	</body>
</html>
