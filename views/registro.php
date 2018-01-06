<?php
//file: view/users/register.php

require_once(__DIR__."/../core/ViewManager.php");
$view = ViewManager::getInstance();

$usuario = $view->getVariable("usuario");
$view->setVariable("title", "Register");
?>



    <div class="container" id="login">
      <center>

				<form action="index.php?controller=users&action=registro" method="post" class ="formulario" role = "form">

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
