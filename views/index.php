<?php
//file: view/posts/index.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/UsuarioController.php");
require_once(__DIR__."/../controller/NotaCompartidaController.php");
$view = ViewManager::getInstance();

$notas = $view->getVariable("nota");
$usuarios = $view->getVariable("usuario");
$currentuser = $view->getVariable("currentusername");
/*
$view->setVariable("nombre", "Nota");
*/

?><h1><?=i18n("notaaas")?></h1>

<div>



<?php
	if (isset($currentuser)){
		$row = UsuarioController::getNotasUsuario($currentuser);
	  $rowC = UsuarioController::getNotasUsuarioCompartidas($currentuser);
?>

	<div id="main-content" >
		<h1><p align= center><?= i18n("MIS NOTAS")?></h1>
		<div class="container">

			<a href="index.php?controller=nota&action=crearNota">
			<button type="button" class="btn btn-default btn-lg" ><span class="glyphicon glyphicon-plus" id="btnCrearNota"></span><?= i18n("Añadir nota")?></button>
			</a>



			<div class="row">

				<?php
				if($row!=null){
					foreach ($row as $nota) {
						$idNota  = $nota->getIdNota();
						$rowCompartir= NotaCompartidaController::getUsu_NotaCompartida($idNota);
				?>

				<div class="col-md-4">
					<h2><?php echo $nota->getNombre() ?></h2>
					<p><?php echo $nota->getContenido() ?></p>

					<p>user <?php echo $currentuser ?></p>
					<p>nota <?php echo $nota->getIdNota() ?></p>

					<input type = "hidden" name="idusu" value="<?php echo $currentuser ?>">
					<input type="hidden"  name="idNot" value = "<?php echo $nota->getIdNota() ?>">

					<a href="index.php?controller=nota&action=modificarNota&id=<?php echo $nota->getIdNota() ?> "><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" id="btnEditar"></span><?= i18n("Editar")?></button></a>
					<a href="index.php?controller=notaCompartida&action=añadirUsuANota&id=<?php echo $nota->getIdNota() ?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-share" id="btnCompartir"></span><?= i18n("Compartir")?></button></a>
					<button type="submit" class="btn btn-default" form="borrar"><span class="glyphicon glyphicon-trash" id="btnEliminar"></span><?= i18n("Eliminar")?></button>

					<form method= "post" action = "index.php?controller=nota&action=deleteNota" id="borrar">
						<input type = "hidden" name="idusu" value="<?php echo $currentuser ?>">
						<input type="hidden"  name="idNot" value = "<?php echo $nota->getIdNota() ?>">
					</form>

				<!--  mostrar la lista de los usu con los que se comparte la nota -->
					<?php
					if($rowCompartir!=null){
					?>

						<a href="index.php?controller=notaCompartida&action=listarCompartido1&id=<?php echo $nota->getIdNota() ?> "><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-user" id="btnUser"></span><?= i18n("Compartido")?></button></a>


				<?php
					}
					?>

</div>
					<?php
				}
				}else{
					?>
					<div>
						<h2><?= i18n("Aun no ha creado ninguna nota")?></h2>
					</div>
					<?php
				}

				?>
	</div>

			</div> <!-- /row -->
		</div> <!-- /container -->
	</div> <!-- /main-content -->





<?php }else{?>


<div class="container" id="login">

	<center >

		<form action="index.php?controller=usuario&action=login"   method="post" class ="formulario" role = "form">
		<!--<form action="index.php?controlador=usuario&amp;accion=login"   method="post" class ="formulario" role = "form">-->
			<label for = "logUsuario"><?= i18n("Nombre de usuario")?>:</label>
			<input type="text" name="logUsuario"><br><br>
			<label for = "conUsuario"><?= i18n("Contraseña")?>:</label>
			<input type="password" name="conUsuario"><br><br>
			<a href="index.php?controller=usuario&action=registro" id="reg"><?= i18n("¡Regístrate aquí!")?></a>


			<button type="submit" class="btn btn-default" id ="reg"><?= i18n("Iniciar sesión")?></button>
		</form>

	</center>

</div>


<?php } ?>
	<div>
