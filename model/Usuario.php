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



      /* Guardamos un Usuario en la BD*/
      public static function guardarUsuario($usuario){
        return UsuarioMapper::guardarUsuario($usuario);
      }
      /*Obtenemos datos del usuario por su nombre*/
      public static function datosUsuario($usuario) {
        if ($usuario) {
                return UsuarioMapper::findByNomUsuario($usuario);
            } else {
                return null;
            }
      }


      /*Comprobacion existe usuario... Si existe usuario devuelve mensaje*/
        public static function obtenerEmail($idNota) {

              if ($res = NotaMapper::esValidoNota($idNota)) {

                    return UsuarioMapper::obtenerUsuario($idNota);
              } else {
                      return NULL;
              }

        }


        /*Comprobamos si se puede registrar el usuario. Si se puede retornamos un TRUE*/
      public static function registroValido($login, $email,$password, $confirmar){
          $error ;
          $errores= array();

           if(UsuarioMapper:: existeUsuario($login)){

            $errores["login"] = "Este nombre de usuario no está disponible";
            $error = i18n("Este nombre de usuario no está disponible");
            header("Location: ../views/error.php?error=$error");
            return false;
         }
         if(UsuarioMapper:: existeUsuarioEmail($email)){
          $errores["email"] = "Este email no está disponible";
            $error = i18n("Este email no está disponible");
            header("Location: ../views/error.php?error=$error");
          return false;
       }

          if (strlen($login) < 4) {
            $errores["login"] = i18n("El nombre de usuario debe tener al menos 4 caracteres");
            $error = i18n("El nombre de usuario debe tener al menos 4 caracteres");
            header("Location: ../views/error.php?error=$error");

          }

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores ["email"]= i18n("La dirección de email introducida no es válida");
            $error= i18n("La dirección de email introducida no es válida");
            header("Location: ../views/error.php?error=$error");
          }

          if (strlen($password) < 5) {
            $errores["password"] = i18n("La contraseña debe tener al menos 5 caracteres");
            $error= i18n("La contraseña debe tener al menos 5 caracteres");
            header("Location: ../views/error.php?error=$error");
          }

          if ($password!=$confirmar) {
              $errores["confirmar"]= i18n("Las contraseñas no coinciden. Por favor, inténtelo de nuevo");
                $error= i18n("Las contraseñas no coinciden. Por favor, inténtelo de nuevo");
              header("Location: ../views/error.php?error=$error");
          }


          if (sizeof($error)==0){
              return true;
          }
      }


      /*Comprobacion existe Usuario... Si existe usuario devuelve un Objeto Usuario*/
      public static function obtenerDatos($login, $password) {
        if ($login && $password) {
            if ($res = UsuarioMapper::esValidoUsuario($login, $password)) {
                    return UsuarioMapper::findByUserName($login);
            } else {
                  return NULL;
                }
            } else {
                return null;
            }
      }
      public static function getNotasCreadas($idUsuario){
        return $resultado = UsuarioMapper::getNotasUsuario($idUsuario);
      }

      public static function getNotasCompartidas($idUsuario){
        return $resultado = UsuarioMapper::getNotasCompartidas($idUsuario);
      }


      /*Obtener idUsuario a partir del email*/
      public static function getUsuario($email){
            return $resultado = UsuarioMapper::getUsuario($email);
      }



}

?>
