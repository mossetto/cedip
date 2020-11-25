<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nomenclador_model
 *
 * @author mario
 */
class Nomenclador_model extends CI_Model
{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    function getLiquidacionObraSocialEntreFechas($fecha1,$fecha2,$obra_social, $especialidad)
    {
        $r = $this->db->query("select pacientes.dni, pacientes.nombre, pacientes.apellido, especialidades.especialidad, obras_sociales.razon_social, turnos.fecha, nomenclador.precio as precio from turnos INNER JOIN pacientes on pacientes.dni = turnos.paciente INNER JOIN obras_sociales on obras_sociales.codigo = pacientes.cod_obra_social INNER JOIN nomenclador on nomenclador.cod_obra_social = pacientes.cod_obra_social INNER JOIN especialidades on especialidades.codigo = turnos.especialidad where turnos.fecha >= '$fecha1' and turnos.fecha <= '$fecha2' order by turnos.fecha and obras_sociales.codigo = $obra_social and especialidad.codigo = $especialidad");
        return $r->result_array();
    }
    
    function getLiquidacionObrasSocialesEntreFechas($fecha1,$fecha2,$obra_social, $especialidad)
    {
        $r= null;
        
        if($obra_social == 0)
        {
            if($especialidad == 0){
                $r = $this->db->query("select p.dni as dni, p.nombre as nombre, p.apellido as apellido, e.especialidad as especialidad, o.razon_social as razon_social, f.fecha as fecha, f.total as precio, n.precio as nomenclador from factura as f, pacientes as p , turnos as t, obras_sociales as o, especialidades as e, nomenclador as n where f.cliente=p.dni and f.turno=t.codigo and t.obra_social=o.codigo and n.cod_obra_social=o.codigo and n.cod_especialidad=t.especialidad and t.especialidad=e.codigo and f.fecha BETWEEN '$fecha1' and '$fecha2' and f.estado='a' order by f.fecha DESC");
            }else{
                $r = $this->db->query("select p.dni as dni, p.nombre as nombre, p.apellido as apellido, e.especialidad as especialidad, o.razon_social as razon_social, f.fecha as fecha, f.total as precio, n.precio as nomenclador from factura as f, pacientes as p , turnos as t, obras_sociales as o, especialidades as e, nomenclador as n where f.cliente=p.dni and f.turno=t.codigo and t.obra_social=o.codigo and n.cod_obra_social=o.codigo and n.cod_especialidad=t.especialidad and t.especialidad=e.codigo and f.fecha BETWEEN '$fecha1' and '$fecha2' and f.estado='a' and e.codigo = $especialidad order by f.fecha DESC");
            }
            
        }
        else
        {
            if($especialidad == 0){
                $r = $this->db->query("select p.dni as dni, p.nombre as nombre, p.apellido as apellido, e.especialidad as especialidad, o.razon_social as razon_social, f.fecha as fecha, f.total as precio, n.precio as nomenclador from factura as f, pacientes as p , turnos as t, obras_sociales as o, especialidades as e, nomenclador as n where f.cliente=p.dni and f.turno=t.codigo and t.obra_social=o.codigo and n.cod_obra_social=o.codigo and n.cod_especialidad=t.especialidad and t.especialidad=e.codigo and f.fecha BETWEEN '$fecha1' and '$fecha2' and f.estado='a' and o.codigo=$obra_social order by f.fecha DESC");
            }else{
                $r = $this->db->query("select p.dni as dni, p.nombre as nombre, p.apellido as apellido, e.especialidad as especialidad, o.razon_social as razon_social, f.fecha as fecha, f.total as precio, n.precio as nomenclador from factura as f, pacientes as p , turnos as t, obras_sociales as o, especialidades as e, nomenclador as n where f.cliente=p.dni and f.turno=t.codigo and t.obra_social=o.codigo and n.cod_obra_social=o.codigo and n.cod_especialidad=t.especialidad and t.especialidad=e.codigo and f.fecha BETWEEN '$fecha1' and '$fecha2' and f.estado='a' and e.codigo = $especialidad order by f.fecha DESC");
            }
            
        }
        return $r->result_array();
    }
    
    function getPrecioActual($especialidad,$obra_social)
    {
        $r = $this->db->query("select nomenclador.precio from nomenclador where nomenclador.cod_especialidad = $especialidad and nomenclador.cod_obra_social = $obra_social and nomenclador.fecha_hasta in (select min(fecha_hasta) as fecha_hasta from nomenclador)");
        return $r->result_array();
    }
}
