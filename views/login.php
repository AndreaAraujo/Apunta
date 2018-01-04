<?php

require_once(__DIR__."/controller/defaultController.php");
include(__DIR__."/views/language_select_element_index.php");
if(!isset($_SESSION)) session_start();

?>

<html>

	<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel ="stylesheet" href="css/bootstrap.min.css">
    <link rel ="stylesheet" href="css/bootstrap.min.css">
    <link rel ="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="favicon.ico">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
	</head>

	<body>
    <div class="container" id="login">

			<center >

        <form action="controller/defaultController.php?controlador=usuario&accion=login"   method="post" class ="formulario" role = "form">
        <!--<form action="index.php?controlador=usuario&amp;accion=login"   method="post" class ="formulario" role = "form">-->
					<label for = "logUsuario"><?= i18n("Nombre de usuario")?>:</label>
					<input type="text" name="logUsuario"><br><br>
					<label for = "conUsuario"><?= i18n("Contraseña")?>:</label>
    	    <input type="password" name="conUsuario"><br><br>
          <a href="views/registro.php" id="reg"><?= i18n("¡Regístrate aquí!")?></a>
          <button type="submit" class="btn btn-default" id ="reg"><?= i18n("Iniciar sesión")?></button>
        </form>
				</form>
      </center>

    </div>
  </body>
</html>
