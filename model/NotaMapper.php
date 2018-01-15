<?php
require_once(__DIR__."/../core/PDOConnection.php");


class NotaMapper{

  private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

  /*Buscamos todos las notas*/
  public  function findAll()
  {
      global $connect;
      $stmt = $this->db->query( 'SELECT * FROM nota ORDER BY nombre');
      $notas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $notas = array();

      foreach ($notas_db as $nota) {

        array_push($notas, new Nota($nota["IdNota"], $nota["nombre"], $nota["contenido"]));
      }

      return $notas;
  }
  /*Buscamos si existe una Nota por su Nombre, devolvemos true si existe*/
  public static function existeNota($nombre) {

    $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM nota WHERE nombre= ? ");
    $stmt->execute(array($nombre));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }

      /*global $connect;
      $resultado = mysqli_query($connect, "SELECT * FROM nota WHERE nombre=\"$nombre\"");
      $busqueda = mysqli_num_rows($resultado);
      if( $busqueda > 0) {

          return true;
      }*/
  }
  /*Buscamos si existe una Nota por su ID, devolvemos true si existe*/
  public static function existeIdNota($idNota) {

    $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM nota WHERE $IdNota= ? ");
    $stmt->execute(array($idNota));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }

    /*  global $connect;
      $resultado = mysqli_query($connect, "SELECT * FROM nota WHERE $IdNota=\"$idNota\"");
      $busqueda = mysqli_num_rows($resultado);
      if( $busqueda > 0) {

          return true;
      }*/
  }

  /* Guardamos una Nota en la BD*/
    public static function guardarNota($nota){

      $stmt = PDOConnection::getInstance()->prepare("INSERT INTO nota (nombre,contenido,Usuario_idUsuario) VALUES (?,?,?) ");
      $stmt->execute(array($nota->getNombre(),$nota->getContenido(),$nota->getUsuario_idUsuario()));

    /*  global $connect;
      $resultado = false;
        $sqlcrear= "INSERT INTO nota (nombre,contenido,Usuario_idUsuario)VALUES ('";
      $sqlcrear = $sqlcrear.$nota->getNombre()."','".$nota->getContenido()."','".$nota->getUsuario_idUsuario()."')";
        $resultado = mysqli_query($connect, $sqlcrear);
       return $resultado;*/
    }

    /*Cogemos todos los datos de una Nota buscandolo por su ID y devolvemos un objeto nota*/
public static function findByIdNota($idNota){

  $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM nota WHERE IdNota= ?");
  $stmt->execute(array($idNota));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if($row != null) {
    $nota= new Nota($row['IdNota'],$row['nombre'],$row['contenido']);
    return $nota;
  } else {
    return NULL;
  }


  /*
    global $connect;
    $resultado = mysqli_query($connect,   "SELECT * FROM nota WHERE IdNota=\"$idNota\"");

    if (mysqli_num_rows($resultado) > 0) {

        $row = mysqli_fetch_assoc($resultado);
      $nota= new Nota($row['IdNota'],$row['nombre'],$row['contenido']);
        return $nota;
    } else {

        return NULL;
    }*/
}




/*Cogemos todos los datos de una Nota buscandolo por su Nombre y devolvemos un objeto Nota*/
  public static function findByNomNota($nombre){
      global $connect;
      $resultado = mysqli_query($connect, 'SELECT * FROM nota WHERE nombre ="'.$nombre.'"');
      if (mysqli_num_rows($resultado) > 0) {
          $row = mysqli_fetch_assoc($resultado);
          $nota= new Nota($row['IdNota'],$row['nombre'],$row['contenido']);
          return $nota;
      } else {
          return NULL;
      }
  }

  /*Mira si la Nota es valido y devuelve true.*/
     public static function esValidoNota($idNota) {
       $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM nota WHERE IdNota= ?");
       $stmt->execute(array($idNota));

         if ($stmt->fetchColumn() > 0) {
          return true;
        }

     }
     /*Buscamos todos las Notas*/
public static function findActBySearch($nombre){

  $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM nota WHERE nombre=? ");
  $stmt->execute(array($nombre));

  /*  global $connect;
    $resultado = mysqli_query($connect, "SELECT * FROM nota WHERE nombre=\"$nombre\" ");
    return $resultado;*/
}



public static function update($idNota,$nombre,$contenido)
  {
    $stmt = PDOConnection::getInstance()->prepare("UPDATE nota SET nombre=?, contenido =? WHERE idNota=? ");
    $stmt->execute(array($idNota,$nombre,$contenido));
      /*global $connect;
      $resultado = mysqli_query($connect, "UPDATE nota SET nombre=\"$nombre\", contenido =\"$contenido\" WHERE idNota=\"$idNota\"");
      return $resultado;*/
  }

  public function delete($idNota){
    $stmt = PDOConnection::getInstance()->prepare("DELETE FROM nota WHERE IdNota= ?");
    $stmt->execute(array($idNota));
  }

  public  function notaByUsuario($idNota,$idUsuario){

    $stmt = PDOConnection::getInstance()->prepare("SELECT * FROM  nota WHERE IdNota= ? and Usuario_idUsuario = ?");
    $stmt->execute(array($idNota, $idUsuario));

    $stmt2 = PDOConnection::getInstance()->prepare("SELECT * FROM  notas_compartidas WHERE idNota= ? and  idUsu= ? ");
    $stmt2->execute(array($idNota, $idUsuario));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }

    if ($stmt2->fetchColumn() > 0) {
      return true;
    }
  }

}

?>
