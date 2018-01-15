<?php
require_once(__DIR__."/../conexion/bdConexion.php");


class NotaCompartidaMapper{

  private $db ;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  public static function findByIdNotaC($idNotaC){

    $stmt = PDOConnection::getInstance()->prepare("SELECT U.email FROM notas_compartidas C, usuario U WHERE C.idUsu = U.idUsuario and  idNota= ?");
    $stmt->execute(array($idNotaC));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row != null) {
      $usuario= $row['email'];
      return $usuario;
    } else {
      return NULL;
    }
    /*
      global $connect;
      $resultado = mysqli_query($connect,  "SELECT U.email FROM notas_compartidas C, usuario U WHERE C.idUsu = U.idUsuario and  idNota=\"$idNotaC\"");

          return $resultado;
*/
  }

  public static function devolverNotaC($idNotaC){
      global $connect;
      $resultado = mysqli_query($connect,  "SELECT * FROM notas_compartidas WHERE idNota=\"$idNotaC\"");
          return $resultado;
  }



  /*Mira si la Nota es valido y devuelve true.*/
     public function esValidoNotaC($idNotaC) {

       $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM notas_compartidas WHERE idNota= ?");
       $stmt->execute(array($idNotaC));

       if ($stmt->fetchColumn() > 0) {
         return true;
       }
     }

     //Mirar si esta el email, y añado Usuarios
     public static function estaEmail($email,$idNotaC){


       global $connect;

       $resultado = mysqli_query($connect,  "SELECT idUsuario FROM usuario WHERE email='".$email."'");
       $busqueda = mysqli_num_rows($resultado);

       if( $busqueda > 0) {//se puede añadir

         $resultado = mysqli_query($connect,  "SELECT * FROM notas_compartidas WHERE idUsu= (SELECT idUsuario FROM usuario WHERE email='".$email."') AND idNota = \"$idNotaC\"");
         $busqueda = mysqli_num_rows($resultado);

             if( $busqueda > 0) {
                return false;

            }else{
              return true;
            }
        }else{

           return false;

        }
     }

     /* Guardamos una NUEVA TUPLA EN notas_compartidas  */
       public static function guardarNuevoUsuarioCompartido($notaC){
         global $connect;
         $resultado = false;
         $sqlcrear= "INSERT INTO notas_compartidas (idNota, idUsu)VALUES('";
         $sqlcrear = $sqlcrear.$notaC->getIdNotaCompartida()."','".$notaC->getIdUsu()."')";
         $resultado = mysqli_query($connect, $sqlcrear);
         return $resultado;
       }

       /*Buscamos si existe una NotaC por su ID, devolvemos true si existe*/
       public static function existeIdNota($idNotaC) {
           global $connect;
           $resultado = mysqli_query($connect, "SELECT * FROM notas_compartidas WHERE $idNota=\"$idNotaC\"");
           $busqueda = mysqli_num_rows($resultado);
           if( $busqueda > 0) {

               return true;
           }
       }

       public static function delete($idNotaC){
           global $connect;
           $resultado = mysqli_query($connect, "DELETE FROM notas_compartidas WHERE idNota=\"$idNotaC\"");
           return $resultado;
       }

       public static function deleteUsu($email){
           global $connect;
           $resultado = mysqli_query($connect, "DELETE FROM notas_compartidas WHERE idUsu=(SELECT IdUsuario FROM usuario WHERE email=\"$email\")");
           return $resultado;
       }

       public static function descompartirN($idUsuario,$idNota){
         global $connect;
         $resultado = mysqli_query($connect, "DELETE FROM notas_compartidas WHERE idUsu=\"$idUsuario\" and idNota=\"$idNota\" ");
         return $resultado;
       }


}
?>
