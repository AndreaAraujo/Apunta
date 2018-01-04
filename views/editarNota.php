
<?php
require_once("../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['IdUsuario'];


  $idNota = $_GET['id'];
  $nota = NotaController::getNota($idNota,$idUsuario);

?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel ="stylesheet" href="../css/bootstrap.min.css">
		<link rel ="stylesheet" href="../css/editarNota.css">
		<link rel="shortcut icon" href="../img/favicon.ico">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>

	</head>


	<header>
		<?php include("navbar.php") ?>
	</header>


	<body style="overflow-y:scroll">
		<div  id="main-content" >
			<h1><p align= center><?= i18n("EDITAR NOTA")?>: <span id ="titulo"><?php echo $nota->getNombre();?></span></h1>

			<div class="container">
      	<form action="../controller/defaultController.php?controlador=nota&accion=modificarNota" method="post" class ="formularioEditar" role = "form">
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

          <button type="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-paperclip" id="btnGuardar"></span><?= i18n("Guardar")?></button>
					<a href="verNotas.php"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>

        </form>
	  	</div>
		</div>


<?php include("footer.php") ?>
	</body>

</html>
