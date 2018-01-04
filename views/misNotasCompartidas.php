
<?php
require_once("../controller/defaultController.php");


if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['IdUsuario'];

  $row = UsuarioController::getNotasUsuarioCompartidas($idUsuario);

?>


<!DOCTYPE html>

<html>

	<head>
    <meta charset="utf-8">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel ="stylesheet" href="../css/bootstrap.min.css">
		<link rel ="stylesheet" href="../css/misNotasCompartidas.css">
		<link rel="shortcut icon" href="../img/favicon.ico">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>
	</head>

	<header >
		<?php include("navbar.php") ?>
	</header>


	<body style="overflow-y:scroll">
	<div id="main-content" >

    <h1><p align= center><?= i18n("Notas que han compartido conmigo")?></h1>
      <div class="container">
        <div class="row">

      <?php

      if($row!=null){
        foreach ($row as $nota) {
            $idNota =$nota['IdNota'];
            $rowCompartir= NotaCompartidaController::getUsu_NotaCompartida($idNota);

            if($rowCompartir!=null){
            ?>

      <div class="col-md-4">
        <h2><?php echo $nota['nombre']; ?></h2>
        <p><?php echo $nota['contenido']; ?></p>






        <a href="editarNota.php?id=<?php echo $nota['IdNota']; ?> "><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" id="btnEditar"></span><?= i18n("Editar")?></button></a>
        <a href="compartirNota.php?id=<?php echo $nota['IdNota']; ?> "><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-share" id="btnCompartir"></span> <?= i18n("Compartir")?></button></a>
        <button type="submit" class="btn btn-default" form="borrar"><span class="glyphicon glyphicon-trash" id="btnEliminar"></span><?= i18n("Eliminar")?></button>

        <form method= "post" action = "../controller/defaultController.php?controlador=notaCompartida&accion=descompartirNota" id="borrar">
          <input type = "hidden" name="idusu" value="<?php echo $idUsuario ?>">
          <input type="hidden"  name="idNot" value = "<?php echo $idNota ?>">
        </form>



      <a href="listaCompartidos2.php?id=<?php echo $nota['IdNota']; ?> "><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-user" id="btnCompartir"></span><?= i18n("Compartido")?></button></a>



          <?php
              }
            ?>


      </div>

      <?php
        }
      }else{
        ?>
        <div >
          <h2><?= i18n("No hay notas compartidas")?></h2>
        </div>
        <?php
      }

      ?>


			</div> <!-- /row -->
		</div> <!-- /container -->

	<!-- /main-content -->
  <a href="verNotas.php"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>

	</div><!-- /main-content -->

	<?php include("footer.php"); ?>

  </body>
</html>