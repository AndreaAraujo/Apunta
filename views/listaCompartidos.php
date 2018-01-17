<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/NotaController.php");
require_once(__DIR__."/../controller/NotaCompartidaController.php");

$view = ViewManager::getInstance();
$idUsuario = $view->getVariable("currentusername");


      $idNotaC = $_GET['id'];
      $nota = NotaController::getNota($idNotaC,  $idUsuario);
      $row= NotaCompartidaController::getUsu_NotaCompartida($idNotaC);

?>

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
               foreach ($row as $notaCompartida) {
                 
             ?>
             <tr>
               <td><?php echo $notaCompartida->getEmail() ?></td>


             <?php
               }
             }
             ?>
           </tbody>
         </table>

        </div>
    </div>
    <a href="index.php?controller=nota&action=index"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>
</div>
