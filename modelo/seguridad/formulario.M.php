<?php
    //Eduardo A. Peña

class Formulario{
    private $idFormulario;
    private $descripcion;
    private $etiqueta;
    private $ubicacion;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
    public $conn=null;

    //idFormulario
    public function getIdFormulario(){return $this->idFormulario;}
    public function setIdFormulario($idFormulario){$this->idFormulario = $idFormulario;}

    //descripcion
    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;}

    //etiqueta
    public function getEtiqueta(){return $this->etiqueta;}
    public function setEtiqueta($etiqueta){$this->etiqueta = $etiqueta;}

    //ubicacion
    public function getUbicacion(){return $this->ubicacion;}
    public function setUbicacion($ubicacion){$this->ubicacion = $ubicacion;}

    //estado
    public function getEstado(){return $this->estado;}
    public function setEstado($estado){$this->estado = $estado;}
    
    //fechaCreacion
    public function getFechaCreacion(){return $this->fechaCreacion;}
    public function setFechaCreacion($fechaCreacion){$this->fechaCreacion = $fechaCreacion;}

    //fechaModificacion
    public function getFechaModificacion(){return $this->fechaModificacion;}
    public function setFechaModificacion($fechaModificacion){$this->fechaModificacion = $fechaModificacion;}

    //idUsuarioCreacion
    public function getIdUsuarioCreacion(){return $this->idUsuarioCreacion;}
    public function setIdUsuarioCreacion($idUsuarioCreacion){$this->idUsuarioCreacion = $idUsuarioCreacion;}

    //idUsuarioModificacion
    public function getIdUsuarioModificacion(){return $this->idUsuarioModificacion;}
    public function setIdUsuarioModificacion($idUsuarioModificacion){$this->idUsuarioModificacion = $idUsuarioModificacion;}

    //conexion
    public function __construct() {$this->conn = new Conexion();}

    public function Agregar(){
        $sentenciaSql = "CALL Agregar('$this->descripcion'
        ,'$this->etiqueta'
        ,'$this->ubicacion'
        ,$this->estado)";
        
        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Modificar(){
        $sentenciaSql = "UPDATE formulario 
        SET 
            descripccion = '$this->descripcion'
            ,etiqueta = '$this->etiqueta'
            ,ubicacion = '$this->ubicacion'
            ,estado = $this->estado
            ,fecha_modificacion = $this->fechaModificacion
            ,id_usuario_modificacion = $this->id_usuario_modificacion
        WHERE id_usuario = $this->idUsuario ";

        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Eliminar(){
        $sentenciaSql = "DELETE FROM 
            formulario 
        WHERE 
            id_usuario = $this->idUsuario";   

        $this->conn->Preparar($sentenciaSql);
        $this->conn->Ejecutar();
        return true;
    }

    public function Consultar(){
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT
           *
        FROM
            formulario $condicion";        		
        
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }
    private function obtenerCondicion(){
     
        
    }


    public function __destruct() {
        unset($this->formulario);
        unset($this->descripcion);
        unset($this->etiqueta);
        unset($this->ubicacion);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }       
}
?>