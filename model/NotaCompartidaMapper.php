<?php
require_once(__DIR__."/../conexion/bdConexion.php");


class NotaCompartidaMapper{

  private $db ;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  public  function findByIdNotaC($idNotaC){

    $stmt = PDOConnection::getInstance()->prepare("SELECT U.email FROM notas_compartidas C, usuario U WHERE C.idUsu = U.idUsuario and  idNota= ?");
    $stmt->execute(array($idNotaC));
    $usu_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $usuarios = array();

    foreach ($usu_db as $usuario) {

      array_push($usuarios, new Usuario($usuario["email"]));


    }
    return $usuarios;
    }
    /*
      global $connect;
      $resultado = mysqli_query($connect,  "SELECT U.email FROM notas_compartidas C, usuario U WHERE C.idUsu = U.idUsuario and  idNota=\"$idNotaC\"");

          return $resultado;
*/


  public function devolverNotaC($idNotaC){

    $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM notas_compartidas WHERE idNota= ?");
    $stmt->execute(array($idNotaC));

  }



  /*Mira si la Nota es valido y devuelve true.*/
     public function esValidoNotaC($idNotaC) {

       $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM notas_compartidas WHERE idNota= ?");
       $stmt->execute(array($idNotaC));

       if ($stmt->fetchColumn() > 0) {
         return true;
       }
       return false;
     }

     //Mirar si esta el email, y añado Usuarios
     public static function estaEmail($email,$idNotaC){

       $stmt = PDOConnection::getInstance()->prepare("SELECT idUsuario FROM usuario WHERE email= ?");
       $stmt->execute(array($email));

       if ($stmt->fetchColumn() > 0) {

         $stmt2 = PDOConnection::getInstance()->prepare("SELECT * FROM notas_compartidas WHERE idUsu= (SELECT idUsuario FROM usuario WHERE email=?) AND idNota =? ");
         $stmt2->execute(array($email,$idNotaC));

             if( $stmt2->fetchColumn()  > 0) {
                return false;

            }else{
              return true;
            }
        }else{

           return false;

        }
     }

     /* Guardamos una NUEVA TUPLA EN notas_compartidas  */
       public function guardarNuevoUsuarioCompartido($notaC){

         $stmt = PDOConnection::getInstance()->prepare("INSERT INTO notas_compartidas (idNota, idUsu) VALUES(?,?)");
         $stmt->execute(array($notaC->getIdNotaCompartida(),$notaC->getIdUsu()));

       }

       /*Buscamos si existe una NotaC por su ID, devolvemos true si existe*/
       public static function existeIdNota($idNotaC) {

         $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM notas_compartidas WHERE idNota=?");
         $stmt->execute(array($idNotaC));

         if ($stmt->fetchColumn() > 0) {
           return true;
         }

       }

       public static function delete($idNotaC){

         $stmt = PDOConnection::getInstance()->prepare("DELETE FROM notas_compartidas WHERE idNota=?");
         $stmt->execute(array($idNotaC));


       }

       public static function deleteUsu($email){
         $stmt = PDOConnection::getInstance()->prepare("DELETE FROM notas_compartidas WHERE idUsu=(SELECT IdUsuario FROM usuario WHERE email= ?)");
         $stmt->execute(array($email));

       }

       public static function descompartirN($idUsuario,$idNota){

         $stmt = PDOConnection::getInstance()->prepare("DELETE FROM notas_compartidas WHERE idUsu=? and idNota=? ");
         $stmt->execute(array($idUsuario,$idNota));

       }


}
?>
