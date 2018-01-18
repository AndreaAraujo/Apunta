<?php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/Nota.php");


class UsuarioMapper{

  private $db ;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /*Buscamos si existe un Usuario por su login, devolvemos true si existe*/
  public static function existeUsuario($login) {

    $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM usuario WHERE login= ? ");
    $stmt->execute(array($login));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  /*Buscamos si existe un Usuario por su email, devolvemos true si existe*/
  public static function existeUsuarioEmail($email) {

    $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM usuario WHERE email= ? ");
    $stmt->execute(array($email));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  /*Cogemos todos los datos del usuario    buscandolo por su ID de lla nota*/
public static function obtenerUsuario($idNota){
  $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM usuario  WHERE IdUsuario = ( SELECT Usuario_idUsuario FROM nota  WHERE IdNota= ? )");
  $stmt->execute(array($idNota));

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if($row != null) {

    $usuario= new Usuario($row['IdUsuario'],$row['login'],$row['password'],$row['email']);
    return $usuario;

  } else {
    return NULL;
  }
}


  /* Guardamos una usuario en la BD*/
    public  function guardarUsuario($usuario){
      $stmt = PDOConnection::getInstance()->prepare("INSERT INTO usuario (login, password, email)VALUES(?,?,?)");
      $stmt->execute(array($usuario->getLogin(), $usuario->getPassword(),$usuario->getEmail()));

    }



   /*Mira si el Usuario es valido y devuelve true.*/
  public  function esValidoUsuario($login, $password) {

      $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM usuario WHERE login=? AND password = ?");
      $stmt->execute(array($login, $password));

      if ($stmt->fetchColumn() > 0) {
  			return true;
  		}
  }

     /*Buscamos Usuario por su LOGIN*/
     public static function findByUserName($login)
     {

       $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM usuario WHERE login =?");
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

       $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM nota WHERE Usuario_idUsuario= ? ");
       $stmt->execute(array($idUsuario));
   		 $notas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

   		 $notas = array();

   		 foreach ($notas_db as $nota) {

   	  		array_push($notas, new Nota($nota["IdNota"], $nota["nombre"], $nota["contenido"]));
   	  	}

   	     return $notas;

     }

     /*Buscamos las notas compartidas por el usuario*/
     public  function getNotasCompartidas($idUsuario){

         $stmt = PDOConnection::getInstance()->prepare("SELECT N.IdNota , N.nombre , N.contenido FROM nota N , notas_compartidas C  WHERE C.idUsu= ? AND  N.IdNota = C.idNota ");
         $stmt->execute(array($idUsuario));
         $notasC_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

     		 $notasC = array();

     		 foreach ($notasC_db as $notaC) {

     	  		array_push($notasC, new Nota($notaC["IdNota"], $notaC["nombre"], $notaC["contenido"]));
     	  	}

     	     return $notasC;
     }

     /*Obtener idUsuario a partir del email*/
     public static function getUsuario($email){

        $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM usuario  WHERE email =? ");
        $stmt->execute(array($email));


        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row != null) {
          $usuario= new Usuario($row['IdUsuario'],$row['login'],$row['password'],$row['email']);
          return $usuario;
        } else {
          return NULL;
        }
     }


}

?>
