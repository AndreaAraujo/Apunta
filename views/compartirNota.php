<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/NotaController.php");
require_once(__DIR__."/../controller/NotaCompartidaController.php");


$view = ViewManager::getInstance();
$idUsuario = $view->getVariable("currentusername");
      $idNotaC =51;// $_GET['id'];
//  $idUsuario = $_GET['id2'];

      $nota = NotaController::getNota($idNotaC, $idUsuario);
      $row= NotaCompartidaController::getUsu_NotaCompartida($idNotaC);

?>

  <div id="main-content" >

    <h1><p align= center><?= i18n("Compartir nota")?>: <span id ="titulo"><?php echo $nota->getNombre();?></span> </h1>
    <div class="container">


   <form action="index.php?controller=notaCompartida&action=añadirUsuANota"  method="post" class="form-horizontal" role = "form">

        <div class ="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class = "form-group">
          <label for = "compartirCon" ><?= i18n("Compartir con")?>:</label>

          <input type = "hidden" name="idusu" value="<?php echo $idUsuario ?>">
          <input type="text" name="email" class ="form-control" id="textBoxCompartirCon" placeholder="email" maxlength="50" >
          <button type="submit" name="submit" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-share" id="btnCompartir"></span> <?= i18n("Compartir")?></button>
          <a href="index.php?controller=nota&action=index"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"><?= i18n("Atrás")?></button></span></a></p>

          <input type="hidden" name="idNotC" value="<?php echo $idNotaC;?>">
          </div>
        </div>

  </form>

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
                <td><?php echo $notaCompartida->getEmail() ?></td>
                <td><a href=""><button type="submit" class="btn btn-default" name="email" form="borrar" ><span class="glyphicon glyphicon-trash" id="btnEliminar"></span><?= i18n("Eliminar")?></button></a>

              </tr>


             <?php
               }
             }
             ?>
             <form method= "post" action = "index.php?controller=notaCompartida&action=borrarUsuCompartido" id="borrar">
                 <input type="hidden"  name="email" value ="<?php echo $notaCompartida->getEmail() ?>">

                    <input type="hidden"  name="id" value ="<?php echo $idNotaC ?>">
             </form>

           </tbody>
         </table>

        </div>
    </div>
</div>
