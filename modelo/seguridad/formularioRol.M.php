<?php
//Eduardo A. Peña

class FormularioRol
{
    private $idFormularioRol;
    private $idRol;
    private $idFormulario;
    private $estado;
    private $fechaCreacion;
    private $fechaModificacion;
    private $idUsuarioCreacion;
    private $idUsuarioModificacion;
   

    //idFormularioRol
    public function getIdFormularioRol()
    {
        return $this->idFormularioRol;
    }
    public function setIdFormularioRol($idFormularioRol)
    {
        $this->idFormularioRol = $idFormularioRol;
    }

    //idRol
    public function getIdRol()
    {
        return $this->idRol;
    }
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;
    }

    //idFormulario
    public function getIdFormulario()
    {
        return $this->idFormulario;
    }
    public function setIdFormulario($idFormulario)
    {
        $this->idFormulario = $idFormulario;
    }

    //estado
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    //fechaCreacion
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    //fechaModificacion
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }

    //idUsuarioCreacion
    public function getIdUsuarioCreacion()
    {
        return $this->idUsuarioCreacion;
    }
    public function setIdUsuarioCreacion($idUsuarioCreacion =1)
    {
        $this->idUsuarioCreacion = $idUsuarioCreacion;
    }

    //idUsuarioModificacion
    public function getIdUsuarioModificacion()
    {
        return $this->idUsuarioModificacion;
    }
    public function setIdUsuarioModificacion($idUsuarioModificacion=1)
    {
        $this->idUsuarioModificacion = $idUsuarioModificacion;
    }

    //conexion
    public function __construct()
    {
        $this->conn = new Conexion();
    }

    public function Agregar()
    {
        $sentenciaSql = "CALL Agregar_formulario_rol('$this->idRol'
                            ,'$this->idFormulario'
                            ,'$this->estado'
                            ,'$this->idUsuarioCreacion'
                            ,'$this->idUsuarioModificacion')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Modificar()
    {
        $sentenciaSql = "CALL Modificar_formulario_rol('$this->idRol'
                            ,'$this->idFormulario'
                            ,'$this->estado'
                            ,'$this->idUsuarioModificacion'
                            ,'$this->idFormularioRol')";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Eliminar()
    {
        $sentenciaSql = "DELETE FROM formulario_rol 
                            WHERE id_formulario_rol = $this->idFormularioRol";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    public function Consultar()
    {
        $condicion = $this->obtenerCondicion();
        $sentenciaSql = "SELECT * 
                            FROM formulario_rol $condicion";
        $this->conn->preparar($sentenciaSql);
        $this->conn->ejecutar();
        return true;
    }

    private function obtenerCondicion()
    {
        $whereAnd = " WHERE ";
        $condicion = " ";

        if($this->IdFormularioRol !=''){
            $condicion=$whereAnd.$condicion." id_FormularioRol  = $this->idFormularioRol";
            $whereAnd = ' AND ';
        }
        if($this->formularioRol !=''){
            $condicion=$condicion.$whereAnd." formularioRol LIKE '%$this->formularioRol%' ";
            $whereAnd = ' AND ';
            return $condicion;
        }
    }

    public function __destruct()
    {
        unset($this->idFormularioRol);
        unset($this->idRol);
        unset($this->idFormulario);
        unset($this->estado);
        unset($this->fechaCreacion);
        unset($this->fechaModificacion);
        unset($this->idUsuarioCreacion);
        unset($this->idUsuarioModificacion);
        unset($this->conn);
    }
}
