<?php


require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/NotaMapper.php");
require_once(__DIR__."/../model/Nota.php");
require_once(__DIR__."/../model/NotaCompartida.php");
require_once(__DIR__."/../core/I18n.php");

class NotaCompartidaController{

            /*Devolver datos de la NotaCompartida*/

            public static function getUsu_NotaCompartida($idNotaC){
              if(!isset($_SESSION)) session_start();

              $notaCompartida = NULL;
              $notaCompartida = NotaCompartida::obtenerDatos($idNotaC);

              if ( NotaCompartidaMapper::esValidoNotaC($idNotaC)) {

                      $notaCompartida = NotaCompartidaMapper::findByIdNotaC($idNotaC);
              } else {
                    $notaCompartida = null;
              }


              if ($notaCompartida == NULL){

                return null;
              }else{
                return $notaCompartida;
              }
            }

            public static function añadirUsuANota(){

              if(!isset($_SESSION)) session_start();
              $idUsuario = $_POST['idusu'];
              $idNotaC = $_POST['idNotC'];
            if(Nota::comprobarNota_Usuario($idNotaC,$idUsuario)){


              $email = $_POST['email'];

              $idNotaC = $_POST['idNotC'];
              if(NotaCompartida::emailValido($email,$idNotaC)){

                $notaC = new NotaCompartida();

                $notaC->setIdNotaCompartida($idNotaC);
                $usuario=UsuarioController::getUsuario($email);
                $idUsu = $usuario['IdUsuario'];
                $notaC->setIdUsu($idUsu);

                $notaC->guardarNuevoUsuarioCompartido($notaC);


               header("Location: ../views/compartirNota.php?id=$idNotaC ");
             }else{

                $error= i18n("Ese email no es válido");
                header("Location: ../views/error.php?error=$error");

             }

           }else{
             $error = "No puedes compartir esta nota";
               header("Location: ../views/error.php?error=$error");

           }
        }


        /* GET nota*/
          public static function getNotaCompartida($idNotaC){
          if(!isset($_SESSION)) session_start();

          $notaCompartida = NULL;
          $notaCompartida = NotaCompartida::obtenerDatos($idNotaC);
          if ($notaCompartida == NULL){
           $error = "No existe la nota ";
            header("Location: ../views/error.php?error=$error");
          }else{
            return $notaCompartida;
          }
        }



        /* BORRAR usuario de la lista de usuarios que comparten la nota*/
        public static function borrarUsuCompartido(){

              $email = $_POST['email'];
              $idNota= $_POST['id'];
                NotaCompartida::deleteUsu($email);
                //Redireccionamos a vista
            header("Location: ../views/compartirNota.php?id=$idNota");


        }

        public static function descompartirNota(){

              $idUsuario = $_POST['idusu'];
              $idNota= $_POST['idNot'];
              NotaCompartida::descompartirN($idUsuario,$idNota);

              header("Location: ../views/verNotas.php");


        }

}
?>
