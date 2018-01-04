<?php
require_once(__DIR__."/../conexion/bdConexion.php");


class NotaMapper{

  /*Buscamos todos las notas*/
  public static function findAll()
  {
      global $connect;
      $resultado = mysqli_query($connect, 'SELECT * FROM nota ORDER BY nombre');
      return $resultado;
  }
  /*Buscamos si existe una Nota por su Nombre, devolvemos true si existe*/
  public static function existeNota($nombre) {
      global $connect;
      $resultado = mysqli_query($connect, "SELECT * FROM nota WHERE nombre=\"$nombre\"");
      $busqueda = mysqli_num_rows($resultado);
      if( $busqueda > 0) {

          return true;
      }
  }
  /*Buscamos si existe una Nota por su ID, devolvemos true si existe*/
  public static function existeIdNota($idNota) {
      global $connect;
      $resultado = mysqli_query($connect, "SELECT * FROM nota WHERE $IdNota=\"$idNota\"");
      $busqueda = mysqli_num_rows($resultado);
      if( $busqueda > 0) {

          return true;
      }
  }

  /* Guardamos una Nota en la BD*/
    public static function guardarNota($nota){
      global $connect;
      $resultado = false;
        $sqlcrear= "INSERT INTO nota (nombre,contenido,Usuario_idUsuario)VALUES ('";
      $sqlcrear = $sqlcrear.$nota->getNombre()."','".$nota->getContenido()."','".$nota->getUsuario_idUsuario()."')";
        $resultado = mysqli_query($connect, $sqlcrear);
       return $resultado;
    }

    /*Cogemos todos los datos de una Nota buscandolo por su ID y devolvemos un objeto nota*/
public static function findByIdNota($idNota){
    global $connect;
    $resultado = mysqli_query($connect,   "SELECT * FROM nota WHERE IdNota=\"$idNota\"");

    if (mysqli_num_rows($resultado) > 0) {

        $row = mysqli_fetch_assoc($resultado);
      $nota= new Nota($row['IdNota'],$row['nombre'],$row['contenido']);
        return $nota;
    } else {

        return NULL;
    }
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
         global $connect;
         $resultado = mysqli_query($connect,  "SELECT * FROM nota WHERE IdNota='".$idNota."'");

         $busqueda = mysqli_num_rows($resultado);
         if( $busqueda > 0) {

             return true;
         }
     }
     /*Buscamos todos las Notas*/
public static function findActBySearch($nombre){
    global $connect;
    $resultado = mysqli_query($connect, "SELECT * FROM nota WHERE nombre=\"$nombre\" ");
    return $resultado;
}



public static function update($idNota,$nombre,$contenido)
  {
      global $connect;
      $resultado = mysqli_query($connect, "UPDATE nota SET nombre=\"$nombre\", contenido =\"$contenido\" WHERE idNota=\"$idNota\"");
         return $resultado;
  }
  public static function delete($idNota){
      global $connect;
    return   $resultado = mysqli_query($connect, "DELETE FROM nota WHERE IdNota=\"$idNota\"");

  }

  public static function notaByUsuario($idNota,$idUsuario){

    global $connect;
    $resultado = mysqli_query($connect,  "SELECT * FROM  nota WHERE IdNota=\"$idNota\" and Usuario_idUsuario = \"$idUsuario\"  ");
    $busqueda = mysqli_num_rows($resultado);

   $resultado2 = mysqli_query($connect,  "SELECT * FROM  notas_compartidas WHERE idNota=\"$idNota\" and  idUsu= \"$idUsuario\" ");
    $busqueda2 = mysqli_num_rows($resultado2);

    if( $busqueda > 0 ) {

        return true;
    }

    if( $busqueda2 > 0) {

        return true;
    }

  }

}

?>
