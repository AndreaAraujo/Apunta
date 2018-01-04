<?php
require_once("../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['IdUsuario'];


      $idNotaC = $_GET['id'];
      $nota = NotaController::getNota($idNotaC ,  $idUsuario);
      $row= NotaCompartidaController::getUsu_NotaCompartida($idNotaC);

?>
<!DOCTYPE html>

<html>

	<head>
    <meta charset="utf-8">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel ="stylesheet" href="../css/bootstrap.min.css">
		<link rel ="stylesheet" href="../css/compartirNota.css">
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

    <h1><p align= center><?= i18n("Compartir nota")?>: <span id ="titulo"><?php echo $nota->getNombre();?></span> </h1>
    <div class="container">

<!-- COMIENZO DIV TABLA -->
  <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table table-striped">
      <thead>
         <tr>
           <th><?= i18n("Compartido con")?>:</th>
        </tr>
       </thead>
           <tbody>
             <?php
             if($row!=null){

                 $usuario =UsuarioController::getAutorNota($idNotaC);
               ?>
               <td id="AutorNota"><b><?= i18n("Autor")?>:</b> <?php echo $usuario->getEmail();?></td>
   <?php
               foreach ($row as $notaCompartida) {
             ?>
             <tr>
               <td><?php echo $notaCompartida['email']; ?></td>


             <?php
               }
             }
             ?>
           </tbody>
         </table>

        </div>
    </div>
    <a href="misNotasCompartidas.php"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>
</div>
  <?php include("footer.php");?>
</body>
</html>
