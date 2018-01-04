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

    /*Comprobacion existe nota... Si existe nota devuelve EMAIL usuario*/
      public static function obtenerDatos($idNotaC) {
        if ($idNotaC) {
            if ($res = NotaCompartidaMapper::esValidoNotaC($idNotaC)) {

                    return NotaCompartidaMapper::findByIdNotaC($idNotaC);
            } else {
                  return null;
            }
        }
      }

      /*Comprobacion existe nota... Si existe nota devuelve Objeto Nota*/
        public static function obtenerDatosNota($idNotaC) {
          if ($idNotaC) {
              if ($res = NotaCompartidaMapper::esValidoNotaC($idNotaC)) {

                      return NotaCompartidaMapper::devolverNotaC($idNotaC);
              } else {
                    return null;
              }
          }
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

        public static function delete($idNotaC){
            NotaCompartidaMapper::delete($idNotaC);
        }
        public static function deleteUsu($email){
            NotaCompartidaMapper::deleteUsu($email);
        }

        public static function descompartirN($idUsuario,$idNota){
            NotaCompartidaMapper::descompartirN($idUsuario,$idNota);
        }

}


?>
