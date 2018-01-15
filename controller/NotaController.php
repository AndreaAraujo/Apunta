<?php


require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/NotaMapper.php");
require_once(__DIR__."/../model/Nota.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class NotaController extends BaseController{

  private $notaMapper;

  public function __construct() {
    parent::__construct();

    $this->notaMapper = new NotaMapper();
  }

  public function index() {

		// obtain the data from the database
		$nota = $this->notaMapper->findAll();

		// put the array containing Post object to the view
		$this->view->setVariable("nota", $nota);

		// render the view (/view/posts/index.php)
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
      if(!isset($_SESSION)) session_start();

        $nombre = $_POST['nomNota'];
        $contenido = $_POST['contenidoNota'];
        $idUsu = $_POST['idUsu'];
        $idNota = "NULL";

        //Comprobamos si los datos introducidos son Correctos
        if(Nota::registroValido($nombre,$contenido)){

          //Creamos el Nota
          $nota = new Nota();

          $nota->setIdNota($idNota);
          $nota->setNombre($nombre);
          $nota->setContenido($contenido);
          $nota->setUsuario_idUsuario($idUsu);

          NotaMapper::guardarNota($nota);

            ViewManager::getInstance()->render("users", "index");
        }

      } //FIN CREAR nota


    /* GET nota*/
  public static function getNota($idNota,$idUsuario){
      if(!isset($_SESSION)) session_start();

      if(NotaMapper::notaByUsuario($idNota,$idUsuario)){

          $nota = NULL;

          if ( NotaMapper::esValidoNota($idNota)) {

                  $nota = NotaMapper::findByIdNota($idNota);
          } else {
                $nota = NULL;
          }

          if ($nota == NULL){
            throw new Exception("No existe la nota");
            /*
           $error = "No existe la nota ";
            header("Location: ../views/error.php?error=$error");*/
          }else{
            return $nota;
          }
    }else{

      throw new Exception("No puedes ver esta nota");
/*
      $error = "No puedes ver esta nota ".$idNota." y usuario: ".$idUsuario."";
        header("Location: ../views/error.php?error=$error");*/

    }
    } // FIN GET nota


    /*MODIFICAR NOTA*/
  public static function modificarNota(){
      if(!isset($_SESSION)) session_start();

      $idNota = $_POST['idNot'];
      $idUsuario = $_POST['idusu'];
  if(NotaMapper::notaByUsuario($idNota,$idUsuario)){

        $contenido=$_POST['contenidoNota'];
        //Utilizamos la nota sin modificar por si no nos pasan unos argumentos, asignarle los que ya tenía
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
            }
          }else{
            throw new Exception("No puedes modificar esta nota");
            /*$error = "No puedes modificar esta nota";
              header("Location: ../views/error.php?error=$error");*/

          }
      }

/*

        public static function borrarNota(){
          if(!isset($_SESSION)) session_start();

            $idNota = $_POST['idNot'];
            $idUsuario = $_POST['idusu'];

          if(Nota::comprobarNota_Usuario($idNota,$idUsuario)){

              //Comprobamos si existe la  nota para poder borrarla
            /*  if(NotaMapper::existeIdNota($idNota)){

                $error = "Entraaa ";
                 header("Location: ../views/error.php?error=$error");*/
                //Nota::delete($idNota);
                //Redireccionamos a vista
              /*  header("Location: ../views/verNotas.php");
            }  */
        /*    }else{
                $error = "No puedes eliminar esta nota";
                header("Location: ../views/error.php?error=$error");

            }

        }*/

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
                      /*  $error = "No puedes eliminar esta nota";
                        header("Location: ../views/error.php?error=$error");
*/
                  }
              }


}

?>
