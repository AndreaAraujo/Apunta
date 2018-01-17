
<?php
require_once(__DIR__."/../core/ViewManager.php");

//if(!isset($_SESSION)) session_start();
$idNota = $_GET['id'];

$view = ViewManager::getInstance();
$idUsuario = $view->getVariable("currentusername");


  $nota = NotaController::getNota($idNota,$idUsuario);

?>


		<div  id="main-content" >
			<h1><p align= center><?= i18n("EDITAR NOTA")?>: <span id ="titulo"><?php echo $nota->getNombre();?></span></h1>

			<div class="container">
      	<form action="index.php?controller=nota&action=modificarNota" method="post" class ="formularioEditar" role = "form">
					<div class ="form-group">
		  			<label for = "nombre" id="labelNombre"><?= i18n("Nombre")?>:</label>
		  			<input type="text" name="Nombre" class ="form-control"  id="textBoxNombre" placeholder="<?php echo $nota->getNombre();?>">
	  			</div>
	  			<div class ="form-group">
		  			<label for = "contenidoNota" id="contenidoNota"><?= i18n("Contenido")?>:</label>
		  			<input type="text" name="contenidoNota" class ="form-control" id="textBoxContenido" placeholder="<?php echo $nota->getContenido();?>" >
	  			</div>

          <input type="hidden" name="idNot" value="<?php echo $nota->getIdNota();?>">
          <input type="hidden" name="idusu" value="<?php echo  $idUsuario ?>">

          <button type="submit" name = "submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-paperclip" id="btnGuardar"></span><?= i18n("Guardar")?></button>
					<a href="index.php?controller=nota&action=index"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>

        </form>
	  	</div>
		</div>
