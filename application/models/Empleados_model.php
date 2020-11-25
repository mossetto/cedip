<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empleados_model
 *
 * @author mario
 */
class Empleados_model extends CI_Model
{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function getTiposEmpleados()
    {
        $result = $this->db->query("select * from tipo_usuario");
        return $result->result_array();
    }
    
    function getHorariosEmpleado($empleado,$hora)
    {
        $result = $this->db->query("select horarios_habilitados.hasta from horarios_habilitados INNER JOIN empleados on empleados.dni = horarios_habilitados.empleado where empleados.dni = $empleado ");
        return $result->row_array();
    }
    
    function getEmpleados()
    {
        $result = $this->db->query("Select * from empleados");
        return $result->result_array();
    }
    
    public function get_modulos_usuario($id)
    {
        $r = $this->db->query("SELECT modulos_usuarios.id_usuario,modulos_usuarios.id_usuario,modulos_usuarios.id_modulo,modulos.modulo as desc_modulo FROM modulos_usuarios INNER JOIN modulos on modulos.id = modulos_usuarios.id_modulo where modulos_usuarios.id_usuario = $id");
        return $r->result_array();
    }
    
    public function get_modulos_faltantes_usuario($id)
    {
        $r = $this->db->query("SELECT modulos.* from modulos where modulos.id not in (SELECT modulos_usuarios.id_modulo as id FROM modulos_usuarios INNER JOIN modulos on modulos.id = modulos_usuarios.id_modulo where modulos_usuarios.id_usuario = $id)");
        return $r->result_array();
    }
    
    public function get_usuario_por_id($id)
    {
        $r = $this->db->query("select * from empleados where dni = $id");
        return $r->row_array();
    }
    
    function getDiaHabilitado($dni)
    {
        $result = $this->db->query("select * from empleados where dni = $dni");
        return $result->row_array();
    }
    
    function actualizarEmpleado($dni,$correo,$usuario,$pass,$nombre,$apellido,$telefono,$movil,$tipo_usuario,$direccion,$cod_sucursal,$cod_localidad,$imagen,$inicio,$operativo)
    {
        $datos = Array(
            "correo"=>$correo,
            "usuario"=>$usuario,
            "pass"=>$pass,
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "telefono"=>$telefono,
            "movil"=>$movil,
            "tipo_usuario"=>$tipo_usuario,
            "direccion"=>$direccion,
            "cod_sucursal"=>$cod_sucursal,
            "cod_localidad"=>$cod_localidad,
            "imagen"=>$imagen,
            "inicio"=>$inicio,
            "operativo"=>$operativo
        );
        
        $this->db->where("dni",$dni);
        
        $respuesta = $this->db->update("empleados",$datos);
        
        return $respuesta;
    }
    
    
    
}
