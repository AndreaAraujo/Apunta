<?php
require_once(__DIR__."/../core/ViewManager.php");


$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
?>

	<div id="main-content" >
		<h1><p align= center><?= i18n("Crear nota")?></h1>

		<div class="container">

      <form action="index.php?controller=nota&action=crearNota"   method="post" class ="formularioCrear" role = "form">

				  <div class ="form-group ">
					  <label for = "nomNota" id="labelNombre"><?= i18n("Nombre")?>:</label>
					  <input type="text"  class ="form-control" name="nomNota"  id="textBoxNombre" maxlength="50">
				  </div>

				  <div class ="form-group">
					  <label for = "contenidoNota" id="contenidoNota"><?= i18n("Contenido")?>:</label>
					  <input type="text" name="contenidoNota" class ="form-control" id="textBoxContenido"  maxlength="300" >
				  </div>

					   <input type="hidden" name="idUsu" value="<?php echo  $idUsuario;?>">

					<button type="submit" name="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-paperclip" id="btnGuardar"></span>Guardar</button>

<!--
            <input type="submit" name="submit" value="Guardar">-->


          <a href="verNotas.php"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>

    </form>
	  </div>
	</div>
