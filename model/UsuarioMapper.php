<?php
require_once(__DIR__."/../core/PDOConnection.php");


class UsuarioMapper{

  private $db ;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /*Buscamos si existe un Usuario por su login, devolvemos true si existe*/
  public static function existeUsuario($login) {
      global $connect;
      $resultado = mysqli_query($connect, "SELECT * FROM usuario WHERE login=\"$login\"");
      $busqueda = mysqli_num_rows($resultado);
      if( $busqueda > 0) {

          return true;
      }
  }

  /*Buscamos si existe un Usuario por su email, devolvemos true si existe*/
  public static function existeUsuarioEmail($email) {
      global $connect;
      $resultado = mysqli_query($connect, "SELECT * FROM usuario WHERE email=\"$email\"");
      $busqueda = mysqli_num_rows($resultado);
      if( $busqueda > 0) {

          return true;
      }
  }

  /*Cogemos todos los datos del usuario    buscandolo por su ID de lla nota*/
public static function obtenerUsuario($idNota){
  global $connect;
  $resultado = mysqli_query($connect,   "SELECT * FROM usuario  WHERE IdUsuario = ( SELECT Usuario_idUsuario FROM nota  WHERE IdNota=\"$idNota\")");

  if (mysqli_num_rows($resultado) > 0) {

      $row = mysqli_fetch_assoc($resultado);
    $usuario= new Usuario($row['IdUsuario'],$row['login'],$row['password'],$row['email']);
      return $usuario;
  } else {

      return NULL;
  }
}


  /* Guardamos una usuario en la BD*/
    public  function guardarUsuario($usuario){
      $stmt = $this->db->prepare("INSERT INTO usuario (login, password, email)VALUES(?,?,?)");
      $stmt->execute(array($usuario->getLogin(), $usuario->getPassword(),$usuario->getEmail()));
      
    }



   /*Mira si el Usuario es valido y devuelve true.*/
  public  function esValidoUsuario($login, $password) {

      $stmt = $this->db->prepare("SELECT * FROM usuario WHERE login=? AND password = ?");
      $stmt->execute(array($login, $password));

      if ($stmt->fetchColumn() > 0) {
  			return true;
  		}
  }

     /*Buscamos Usuario por su LOGIN*/
     public static function findByUserName($login)
     {

       $stmt = $this->db->prepare("SELECT * FROM usuario WHERE login =?");
       $stmt->execute(array($login));
       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       if($row != null) {
         $usuario= new Usuario($row['IdUsuario'],$row['login'],$row['password'],$row['email']);
         return $usuario;
       } else {
         return NULL;
       }
     }

     public  function getNotasUsuario($idUsuario){
       $stmt = $this->db->prepare("SELECT * FROM nota WHERE Usuario_idUsuario= ? ");
       $stmt->execute(array($idUsuario));

       if ($stmt->fetchColumn() > 0) {
         return $stmt;
       }else{

         return NULL;
       }
     }

     /*Buscamos las notas compartidas por el usuario*/
     public static function getNotasCompartidas($idUsuario){
       global $connect;
         $resultado = mysqli_query($connect, 'SELECT N.IdNota , N.nombre , N.contenido FROM nota N , notas_compartidas C  WHERE C.idUsu= "'.$idUsuario.'" AND  N.IdNota = C.idNota  ');
         if (mysqli_num_rows($resultado) > 0) {
             return $resultado;
         } else {
             return NULL;
         }
     }

     /*Obtener idUsuario a partir del email*/
     public static function getUsuario($email){
       global $connect;
         $resultado = mysqli_query($connect, 'SELECT * FROM usuario  WHERE email = "'.$email.'"');
         if (mysqli_num_rows($resultado) > 0) {
             $row = mysqli_fetch_assoc($resultado);
             return $row;
         } else {
             return NULL;
         }
     }


}

?>
