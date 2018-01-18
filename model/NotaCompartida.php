<?php
require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/NotaCompartidaMapper.php");


class NotaCompartida {

  protected $idUsu;
  protected $idNotaC;
  /*
      Constructor de la NOTA_compatida
    */
    public function __construct($idUsu=NULL,$idNotaC=NULL) {
      $this->idUsu = $idUsu;
      $this->idNotaC = $idNotaC;

    }


    public function getIdNotaCompartida() {
      return $this->idNotaC;
    }
    public function setIdNotaCompartida($idNotaC) {
      $this->idNotaC = $idNotaC;
    }

    public function getIdUsu() {
      return $this->idUsu;
    }
    public function setIdUsu($idUsu) {
      $this->idUsu = $idUsu;
    }

      //Comprobar si es valido el email
      public static function emailValido($email,$idNotaC){

          if (strlen($email) < 10 || strlen($email) > 50) {
           return false;
         }
         if(NotaCompartidaMapper::estaEmail($email,$idNotaC)){
           return true;
         }else{

           return false;

         }
      }

        public static function guardarNuevoUsuarioCompartido($notaC){
              return NotaCompartidaMapper::guardarNuevoUsuarioCompartido($notaC);
        }
/*
        public static function delete($idNotaC){
            NotaCompartidaMapper::delete($idNotaC);
        }*/



}


?>
