<?php

include '../../entorno/conexion.php';
require '../../modelo/produccion/tarea.M.php';

$respuesta=array();

$accion=$_POST['accion'];
if(isset($accion)){
    switch($accion){
        case 'ADICIONAR':
            try {
                $tarea=new Tarea();
                $tarea->setValorUnitario($_POST['valorUnitario']);
                $tarea->setDescripcion($_POST['descripcion']);
                $tarea->setCantidad($_POST['cantidad']);
                $tarea->setFecha($_POST['fecha']);
                $tarea->setEstadoPago($_POST['estadoPago']);
                $tarea->setEstado($_POST['estado']);
                $tarea->setIdUsuarioCreacion();
                $tarea->setIdUsuarioModificacion();
                $resultado=$tarea->Agregar();
                $respuesta['respuesta']="La información se adicionó correctamente";
            } catch (Exception $e) {
                $respuesta['respuesta']="Error, no fué posible adicionar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ADICIONAR';
            echo json_encode($respuesta);
        break;
        case 'MODIFICAR':
            try {
                $tarea=new Tarea();
                $tarea->setIdTarea(['id']);
                $tarea->setValorUnitario($_POST['valorUnitario']);
                $tarea->setDescripcion($_POST['descripcion']);
                $tarea->setCantidad($_POST['cantidad']);
                $tarea->setFecha($_POST['fecha']);
                $tarea->setEstadoPago($_POST['estadoPago']);
                $tarea->setEstado($_POST['estado']);
                //$tarea->setIdUsuarioCreacion();
                $tarea->setIdUsuarioModificacion();
                $resultado=$tarea->Agregar();
                $respuesta['respuesta']="La información se modificoó correctamente";
            } catch (Exception $e) {
                $respuesta['respuesta']="Error, no fué posible modificar la información, consulte con el administrador.";
            }
            $respuesta['accion']='MODIFICAR';
            echo json_encode($respuesta);
        break;
        case 'ELIMINAR':
            try{
                $tarea = new Tarea();
                $tarea->setIdTarea($_POST['id']);
                $resultado = $tarea->Eliminar();
                $respuesta['respuesta']="La información se eliminó correctamente.";
            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible eliminar la información, consulte con el administrador.";
            }
            $respuesta['accion']='ELIMINAR';
            echo json_encode($respuesta);
        break;
        case 'CONSULTAR':
            try{
                $tarea=new Tarea();
                $tarea->setIdTarea(['id']);
                $tarea->setValorUnitario($_POST['valorUnitario']);
                $tarea->setDescripcion($_POST['descripcion']);
                $tarea->setCantidad($_POST['cantidad']);
                $tarea->setFecha($_POST['fecha']);
                $tarea->setEstadoPago($_POST['estadoPago']);
                $tarea->setEstado($_POST['estado']);
                $tarea->setIdEmpleado($_POST['idEmpleado']);
                $resultado = $usuario->consultar();

                $numeroRegistros = $usuario->conn->obtenerNumeroRegistros();
                if($numeroRegistros === 1){
                    if ($rowBuscar = $usuario->conn->obtenerObjeto()){
                        $respuesta['id'] = $rowBuscar->id_tarea;
                        $respuesta['valorUnitario'] = $rowBuscar->valor_unitario;
                        $respuesta['descripcion'] = $rowBuscar->descripcion;
                        $respuesta['cantidad'] = $rowBuscar->cantidad;
                        $respuesta['fecha'] = $rowBuscar->fecha;
                        $respuesta['estadoPago'] = $rowBuscar->estado_pago;
                        $respuesta['idEmpleado'] = $rowBuscar->id_empleado;
                        $respuesta['empleado']=$rowBuscar->nombre;  //modificar despues x empleado
                        $respuesta['estado'] = $rowBuscar->estado;
                        $respuesta['eliminar'] = "<input type='button' name='eliminar' class='eliminar' value='Eliminar' onclick='Enviar(\"ELIMINAR\",".$rowBuscar->id_usuario.")'>";
                        
                    }
                }else{
                    if(isset($resultado)){
                        $retorno="<table>";
                        foreach($tarea->conn->ObtenerRegistros()AS $rowConsulta){
                            $retorno .= "<tr>                                          
                                        <td><label>".$rowConsulta[1]."</label></td>                                             
                                        <td><label>".$rowConsulta[2]."</label></td>                                        
                                        <td><label>".$rowConsulta[3]."</label></td>                                                                                               
                                        <td><label>".$rowConsulta[4]."</label></td>
                                        <td><label>".$rowConsulta[7]."</label></td>
                                        <td><label>".($rowConsulta[5]== 1 ? 'Activo':'Inactivo')."</label></td>
                                        <td align='center'><a href='#' class='btn btn-warning'><i class='fas fa-edit' onclick='Enviar(\"CONSULTAR\",".$rowConsulta[0].")'></i></a></td>
                                        <td align='center'><a href='#' class='btn btn-danger'><i class='fas fa-trash' onclick='Enviar(\"ELIMINAR\",".$rowConsulta[0].")'></i></a></td>                                                                                
                                        </tr>";
                        }
                        
                        $retorno.="</table>";
                        $respuesta['tablaRegistro']=$retorno;
                    }else{
                    $respuesta['tablaRegistros']='No existen datos!!';
                    }
                }

            }catch(Exception $e){
                $respuesta['respuesta']="Error, no fué posible consultar la información, consulte con el administrador.";
            }    
            $respuesta['numeroRegistros']=$numeroRegistros;
            $respuesta['accion']='CONSULTAR';
            echo json_encode($respuesta);
        break;
    }
}
?>