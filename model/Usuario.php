<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/UsuarioMapper.php");
require_once(__DIR__."/../core/I18n.php");

class Usuario {
  protected $IdUsuario;
  protected $login;
  protected $password;
  protected $email;
  protected $confirmar;


  /*
      Constructor del Usuario
    */
    public function __construct($IdUsuario=NULL,$login= NULL, $password=NULL, $email=NULL  ) {
      $this->IdUsuario = $IdUsuario;
      $this->login = $login;
      $this->password = $password;
      $this->email= $email;


    }

    public function getIdUsuario() {
      return $this->IdUsuario;
    }
    public function setIdUsuario($idUsuario) {
      $this->IdUsuario = $IdUsuario;
    }

    public function getLogin() {
      return $this->login;
    }
    public function setLogin($login) {
      $this->login = $login;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
      return $this->email;
    }
    public function setEmail($email) {
      $this->email = $email;
    }



        /*Comprobamos si se puede registrar el usuario. Si se puede retornamos un TRUE*/
      public static function registroValido($login, $email,$password, $confirmar){
          $error ;
          $errores= array();

           if(UsuarioMapper:: existeUsuario($login)){

            $errores["login"] = "Este nombre de usuario no está disponible";
            return false;
         }
         if(UsuarioMapper:: existeUsuarioEmail($email)){
          $errores["email"] = "Este email no está disponible";
       }

          if (strlen($login) < 4) {
            $errores["login"] = i18n("El nombre de usuario debe tener al menos 4 caracteres");
          }

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores ["email"]= i18n("La dirección de email introducida no es válida");
          }

          if (strlen($password) < 5) {
            $errores["password"] = i18n("La contraseña debe tener al menos 5 caracteres");
        }

          if ($password!=$confirmar) {
              $errores["confirmar"]= i18n("Las contraseñas no coinciden. Por favor, inténtelo de nuevo");
          }


          if (sizeof($errores)>0){

            return false;
      		}
          return true;
      }


}

?>
