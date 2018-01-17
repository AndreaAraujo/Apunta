<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/NotaMapper.php");
require_once(__DIR__."/../model/Nota.php");
require_once(__DIR__."/../model/NotaCompartida.php");
require_once(__DIR__."/../model/NotaCompartidaMapper.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../controller/UsuarioController.php");

class NotaCompartidaController extends BaseController{



      public function verMisNotasCompartidas() {

    		ViewManager::getInstance()->render("nota", "misNotasCompartidas");
    	}


            /*Devolver datos de la NotaCompartida*/

      public function getUsu_NotaCompartida($idNotaC){


              if ( NotaCompartidaMapper::esValidoNotaC($idNotaC)) {

                      $notaCompartida = NotaCompartidaMapper::findByIdNotaC($idNotaC);

              } else {

                    $notaCompartida = null;
              }
                return $notaCompartida;

            }

        public function listarCompartido1(){

           ViewManager::getInstance()->render("notaCompartida", "listaCompartidos");
         }
         public function listarCompartido2(){

            ViewManager::getInstance()->render("notaCompartida", "listaCompartidos2");
          }


        public function listar(){

           ViewManager::getInstance()->render("notaCompartida", "compartirNota");
        }

      public function añadirUsuANota(){

        if (isset($_POST["submit"])) {
              //if(!isset($_SESSION)) session_start();
              $idUsuario = $_POST['idusu'];
              $idNotaC = $_POST['idNotC'];

            if(NotaMapper::notaByUsuario($idNotaC,$idUsuario)){


              $email = $_POST['email'];
              $idNotaC = $_POST['idNotC'];
              if(NotaCompartida::emailValido($email,$idNotaC)){

                $notaC = new NotaCompartida();

                $notaC->setIdNotaCompartida($idNotaC);
                $usuario=UsuarioController::getUsuario($email);
                $idUsu = $usuario->getIdUsuario();
                $notaC->setIdUsu($idUsu);

                $notaC->guardarNuevoUsuarioCompartido($notaC);


               ViewManager::getInstance()->redirect("notacompartida", "listar");
             }else{

                throw new Exception("Ese email no es válido");

             }

           }else{
             throw new Exception("No puedes compartir esta nota");
           }
         }
         ViewManager::getInstance()->render("notaCompartida", "compartirNota");

        }


        /* GET nota*/
          public static function getNotaCompartida($idNotaC){
          if(!isset($_SESSION)) session_start();

          $notaCompartida = NULL;
          $notaCompartida = NotaCompartida::obtenerDatos($idNotaC);
          if ($notaCompartida == NULL){
             throw new Exception("No existe la nota");

          }else{
            return $notaCompartida;
          }
        }



        /* BORRAR usuario de la lista de usuarios que comparten la nota*/
        public static function borrarUsuCompartido(){

              $email = $_POST['email'];
              //$idNota= $_POST['idc'];
              die($email);
              NotaCompartidaMapper::deleteUsu($email);

            ViewManager::getInstance()->render("notaCompartida", "index");


        }

        public static function descompartirNota(){

              $idUsuario = $_POST['idusu'];
              $idNota= $_POST['idNot'];
              NotaCompartida::descompartirN($idUsuario,$idNota);

              ViewManager::getInstance()->render("notaCompartida", "misNotasCompartidas");


        }

}
?>
