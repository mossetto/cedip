<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profesionales_model
 *
 * @author mario
 */
class Profesionales_model extends CI_Model
{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    
    function getListadoProfesionales()
    {
        $resultado = $this->db->query("select profesionales.codigo, profesionales.matricula, empleados.dni,empleados.correo,empleados.usuario,empleados.pass,empleados.nombre,empleados.apellido,empleados.telefono,empleados.movil,empleados.tipo_usuario,empleados.direccion,empleados.cod_sucursal,empleados.cod_localidad,empleados.imagen,empleados.inicio,empleados.operativo from profesionales INNER JOIN empleados on empleados.dni = profesionales.cod_usuario order by profesionales.codigo desc");
        return $resultado->result_array();
    }
    
    
    function getProfesional($codigo)
    {
        $result = $this->db->query("select profesionales.codigo, profesionales.matricula, empleados.dni,empleados.correo,empleados.usuario,empleados.pass,empleados.nombre,empleados.apellido,empleados.telefono,empleados.movil,empleados.tipo_usuario,empleados.direccion,empleados.cod_sucursal,empleados.cod_localidad,empleados.imagen,empleados.inicio,empleados.operativo from profesionales INNER JOIN empleados on empleados.dni = profesionales.cod_usuario where profesionales.codigo = $codigo");
        return $result->result_array();
    }
    
    function getProfesionalesPorEspecialidad($cod_especialidad)
    {
        $result = $this->db->query("select profesionales.codigo,empleados.nombre,empleados.apellido, empleados.imagen, empleados.inicio from profesionales INNER JOIN especialidades_profesionales on especialidades_profesionales.cod_profesional = profesionales.codigo INNER JOIN empleados on empleados.dni = profesionales.cod_usuario where especialidades_profesionales.especialidad = $cod_especialidad");
        return $result->result_array();
    }
    
    function eliminarprofesional($codigo_profesional)
    {
       $result = $this->db->query("delete from profesionales where codigo = $codigo_profesional");
       return $result->result_array();
    }
    
    function eliminarEspecialidadesDeprofesional($codigo_profesional)
    {
       $result = $this->db->query("delete from especialidades_profesionales where cod_profesional = $codigo");
       return $result->result_array();
    }
    
    function getEspecialidadesProfesional($cod_profesional)
    {
       $result = $this->db->query("select DISTINCT(especialidades.codigo),especialidades.especialidad from especialidades INNER JOIN especialidades_profesionales on especialidades_profesionales.especialidad = especialidades.codigo where especialidades_profesionales.cod_profesional = $cod_profesional");
       return $result->result_array();
    }
    
    function getNombreApellidoProfesional($cod_profesional)
    {
        $result = $this->db->query("select empleados.nombre,empleados.apellido from empleados INNER JOIN profesionales on profesionales.cod_usuario = empleados.dni where profesionales.codigo=$cod_profesional");
        return $result->result_array();
    }
    
    function agregarEspecialidad($cod_profesional,$cod_especialidad)
    {
        $datos = Array(
            "cod_profesional"=>$cod_profesional,
            "especialidad"=>$cod_especialidad,
        );
        
        return $this->db->insert("especialidades_profesionales",$datos);
    }
    
    function borrar_especialidad_profesional($cod_profesional,$cod_especialidad)
    {
        $this->db->where('cod_profesional',$cod_profesional);
        $this->db->where('especialidad',$cod_especialidad);
        return $this->db->delete('especialidades_profesionales');
    }
    
    function agregar_especialidad_profesional($cod_profesional,$cod_especialidad)
    {
        $datos = Array(
            "cod_profesional"=>$cod_profesional,
            "especialidad"=>$cod_especialidad,
        );
        
        $this->db->insert("especialidades_profesionales",$datos);
    }
    
    function obtener_especialidades_faltantes_profesional($cod_profesional)
    {
        $result = $this->db->query("select especialidades.codigo,especialidades.especialidad from especialidades where especialidades.codigo not in (select especialidades.codigo from especialidades INNER JOIN especialidades_profesionales on especialidades_profesionales.especialidad = especialidades.codigo where especialidades_profesionales.cod_profesional = $cod_profesional)");
        return $result->result_array();
    }
    
    function getProfesionalesNoAgregados()
    {
        $result = $this->db->query("select * from empleados where tipo_usuario = 4 and empleados.dni not in (select profesionales.cod_usuario from profesionales);");
        return $result->result_array();
    }
    
    function actualizarProfesional($cod_profesional,$matricula)
    {
        $datos = Array(
            "matricula"=>$matricula,
        );
        
        $this->db->where("codigo",$cod_profesional);
        
        return $this->db->update("profesionales",$datos);
    }
    
    function agregarProfesional($dni)
    {
        $datos = Array(
            "codigo"=>null,
            "cod_usuario"=>$dni,
            "matricula"=>"",
        );
        
        return $this->db->insert("profesionales",$datos);
    } 
    
    function getCodigoProfesionalPorDni($dni)
    {
        $result = $this->db->query("select profesionales.codigo from profesionales where profesionales.cod_usuario = $dni");
        return $result->result_array();
    }
}
