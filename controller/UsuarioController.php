<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../model/UsuarioMapper.php");
require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../core/PDOConnection.php");


class UsuarioController extends BaseController{

  private $usuarioMapper;
  protected $view ;

  public function __construct() {
    parent::__construct();
    $this->view = ViewManager::getInstance();

    $this->usuarioMapper = new UsuarioMapper();


    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    $this->view->setLayout("default");
  //  ViewManager::getInstance()->render("usuario", "index");
  }


    /* GET usuario*/
      public static function getAutorNota($idNota){
      if(!isset($_SESSION)) session_start();

      $usuario = NULL;

      if ($usuario = NotaMapper::esValidoNota($idNota)) {

            $usuario = UsuarioMapper::obtenerUsuario($idNota);
      } else {
              $usuario = NULL;
      }


      if ($usuario == NULL){
    /*   $error = "No existe el usuario ";
        header("Location: ../views/error.php?error=$error");*/
          throw new Exception("No existe el usuario");
      }else{
        return $usuario;
      }
    } // FIN GET usuario*/


    public static function registro() {
      if(!isset($_SESSION)) session_start();

      $login = $_POST['logUsuario'];
      $email = $_POST['emailUsuario'];
      $password = md5($_POST['conUsuario']);
      $confirmar= md5($_POST['confirmar']);
      $idUsuario = "NULL";


      //Comprobamos si los datos introducidos son correctos
  		if(Usuario::registroValido($login, $email, $password, $confirmar)){

        //Creamos el usuario
        $usuario = new Usuario();


        $usuario->setLogin($login);
        $usuario->setEmail($email);
        $usuario->setPassword($password);


        UsuarioMapper::guardarUsuario($usuario);

        $this->view->render("views", "index");
      }

      // Put the User object visible to the view
  		$this->view->setVariable("usuario", $usuario);

  		// render the view (/view/users/register.php)
  		$this->view->render("views", "registro");

    } //FIN Registrar Usuario*/



      public static function login() {
    		/*Comprobamos si nos pasan un Usuario por metodo POST*/

    	    if (isset($_POST["logUsuario"]) && isset($_POST["conUsuario"])){



              if ($_POST["logUsuario"] &&  md5($_POST["conUsuario"])) {
                  if ($res = UsuarioMapper::esValidoUsuario($_POST["logUsuario"] ,  md5($_POST["conUsuario"]))) {
                          $usuario = UsuarioMapper::findByUserName($_POST["logUsuario"] );
                  } else {
                        $usuario = NULL;
                  }

             } else {
                      $usuario = null;
             }

    				//User no existe
    				if ($usuario==NULL) {

    					$_SESSION["currentuser"] = null;
              throw new Exception("Usuario no valido");
    					/*$error= i18n("Nombre de usuario y/o contraseña incorrectos");
    					header("Location: ../views/error.php?error=$error");*/

    				}else{
    					$_SESSION["currentuser"] = $usuario->getIdUsuario();
                header("Location: index.php");
    			    }
    	    }else{
    	    		$_SESSION["currentuser"] = null;
              throw new Exception("Usuario no valido");
    				/*$error= i18n("Nombre de usuario y/o contraseña incorrectos");
    				header("Location: ../views/error.php?error=$error");*/
          }




    	  }


    	public static function logout() {
    		/*if(!isset($_SESSION)) session_start();
    		session_unset();
    		session_destroy();
    		// redireccionamos
    		ViewManager::getInstance()->render("usuario", "index");
    		die();*/

        session_destroy();

    		 ViewManager::getInstance()->render("users", "index");
      }


        /*Obtenemos todos las notas creadas por el usuario*/
      	public  function getNotasUsuario($idUsuario){
      	//	if(!isset($_SESSION)) session_start();
      				 $nota = UsuarioMapper::getNotasUsuario($idUsuario);

      				 return $nota;
      	}

        /*Obtenemos todos las notas compartidas con otros*/
      	public static function getNotasUsuarioCompartidas($idUsuario){
      		if(!isset($_SESSION)) session_start();
      				 $nota =  UsuarioMapper::getNotasCompartidas($idUsuario);

      				 return $nota;
      	}

        /*Obtener idUsuario a partir del email*/
        public static function getUsuario($email){
      		if(!isset($_SESSION)) session_start();
      				 $usuario = UsuarioMapper::getUsuario($email);

      				 return $usuario;
      	}


}

?>
