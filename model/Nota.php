<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/NotaMapper.php");


class Nota {
  protected $idNota;
  protected $nombre;
  protected $contenido;
  protected $Usuario_idUsuario;


  /*
      Constructor de la NOTA
    */
    public function __construct($idNota=NULL,$nombre=NULL, $contenido=NULL, $Usuario_idUsuario=NULL) {
      $this->idNota = $idNota;
      $this->nombre = $nombre;
      $this->contenido = $contenido;
      $this->Usuario_idUsuario = $Usuario_idUsuario;

    }

    public function getIdNota() {
      return $this->idNota;
    }
    public function setIdNota($idNota) {
      $this->idNota = $idNota;
    }

    public function getNombre() {
      return $this->nombre;
    }
    public function setNombre($nombre) {
      $this->nombre = $nombre;
    }

    public function getContenido() {
      return $this->contenido;
    }
    public function setContenido($contenido) {
      $this->contenido = $contenido;
    }
    public function getUsuario_idUsuario() {
      return $this->Usuario_idUsuario;
    }
    public function setUsuario_idUsuario($Usuario_idUsuario) {
      $this->Usuario_idUsuario = $Usuario_idUsuario;
    }

    /*Obtener todos las notas*/
    public static function getAllNotas()
      {
          return $resultado = NotaMapper::findAll();
      }

      /*Obtenemos datos de la nota por su nombre */
      public static function datosNota($nombre) {
        if ($nombre) {
                return NotaMapper::findByNomNota($nombre);
            } else {
                return NULL;
            }
      }


        /*Comprobamos si se puede registrar la Nota. Si se puede retornamos un TRUE*/
public static function registroValido($nombre,$contenido){
    $errors = array();


    if (strlen(trim($nombre)) < 1 || strlen(trim($nombre)) > 50) {
     $errors["nombre"] = "El nombre de la Nota debe tener entre 3 y 50 caracteres";

    }
    if (strlen(trim($contenido)) < 1 || strlen(trim($contenido)) > 300) {
     $errors["contenido"] = "El contenido de la Nota debe tener entre 5 y 300 caracteres";

    }

    if (sizeof($errors) > 0){
      return false;
    }
    return true;
}

public static function notasBuscadas($nombre) {
    if (NotaMapper::existeNota($nombre)) {
            return NotaMapper::findActBySearch($nombre);
        } else {
            return NULL;
        }
  }

}


  ?>
