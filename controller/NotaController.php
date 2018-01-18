<?php


require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/NotaMapper.php");
require_once(__DIR__."/../model/Nota.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../controller/UsuarioController.php");

class NotaController extends BaseController{

  private $notaMapper;

  public function __construct() {
    parent::__construct();

    $this->notaMapper = new NotaMapper();
  }

  public function index() {

		$this->view->render("nota", "index");
	}


  /*Obtenemos todos las notas*/
  public static function getAll(){
        if(!isset($_SESSION)) session_start();
        $notas = new Nota();
        return $notas->getAllNotas();
    }

  /*CREAR NOTA*/
    public static function crearNota(){
      //if(!isset($_SESSION)) session_start();

      if (isset($_POST["submit"])) {

        $nombre = $_POST['nomNota'];
        $contenido = $_POST['contenidoNota'];
        $idUsuario = $_POST['idUsu'];

        //Comprobamos si los datos introducidos son Correctos
        if(Nota::registroValido($nombre,$contenido)){

          //Creamos el Nota
          $nota = new Nota();

          $nota->setNombre($nombre);
          $nota->setContenido($contenido);
          $nota->setUsuario_idUsuario($idUsuario);

          NotaMapper::guardarNota($nota);

          ViewManager::getInstance()->redirect("nota", "index");
        }else{
            throw new Exception("Nota no valida");
        }
      }else{
        ViewManager::getInstance()->render("notas", "crearNota");
      }
      } //FIN CREAR nota


    /* GET nota*/
   public static function getNota($idNota,$idUsuario){

      if(NotaMapper::notaByUsuario($idNota,$idUsuario)){

          if ( NotaMapper::esValidoNota($idNota)) {

                  $nota = NotaMapper::findByIdNota($idNota);
          } else {
                $nota = NULL;
          }

          if ($nota == NULL){
            throw new Exception("No existe la nota");

          }else{
            return $nota;
          }
    }else{

      throw new Exception("No puedes ver esta nota");

    }

    } // FIN GET nota


    /*MODIFICAR NOTA*/
  public function modificarNota(){

      if (isset($_POST["submit"])) {
          $idNota = $_POST["idNot"];
          $idUsuario =  $_POST["idusu"];

      if(NotaMapper::notaByUsuario($idNota,$idUsuario)){

            $contenido=$_POST['contenidoNota'];

            if (NotaMapper::esValidoNota($idNota)) {

                $notaSinModificar = NotaMapper::findByIdNota($idNota);

            } else {
                    $notaSinModificar = NULL;
            }

            //Si no pasan nombre, cogemos el nombre que ya tenia
            if ($_POST['Nombre']!= null) {
              $nombre = $_POST['Nombre'];
            }else{
              $nombre = $notaSinModificar->getNombre();
            }
            //Si no pasan contenido, cogemos elcontenido que ya tenia
            if ($_POST['contenidoNota']!= null) {
              $contenido = $_POST['contenidoNota'];
            }else{
              $contenido = $notaSinModificar->getContenido();
            }

              //Comprobamos si los datosintroducidos son Correctos
              if(Nota::registroValido($nombre,$contenido)){

                  //Llamamos a la funcion que modifica la Nota
                  $nota = NotaMapper::update($idNota, $nombre,$contenido);
                  ViewManager::getInstance()->render("users", "index");
                }else{

                    throw new Exception("Nota no valida");
                }
            }else{
                throw new Exception("No puedes modificar esta nota");
             }
          }
            ViewManager::getInstance()->render("users", "editarNota");
      }



      public static function deleteNota(){
          if(!isset($_SESSION)) session_start();

          $idUsuario = $_POST['idusu'];
          $idNota = $_POST['idNot'];

            if(NotaMapper::notaByUsuario($idNota,$idUsuario)){
                $idNota = $_POST['idNot'];
                NotaMapper::delete($idNota);
                  //Redireccionamos a vista
                  ViewManager::getInstance()->render("users", "index");
            }else{
              	throw new Exception("No puedes eliminar esta nota");
              }
          }

}

?>
