<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente_model
 *
 * @author Adrian Sirianni
 */
class Reportes_model extends CI_Model
{
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    
    
    
    
        
    function obtener_listado_obras_sociales_agurpadas($fecha_desde,$fecha_hasta,$cobrado) {
        $sql="select o.razon_social as razon_social, count(t.codigo) as turnos, "
                . "round(sum(t.importe),2) as importe "
                . "from turnos as t, obras_sociales as o "
                . "where t.obra_social=o.codigo ";
        
            if($cobrado=='si'){
                $sql.="and t.cobrado= 'si' ";
            }
            if($cobrado=='no'){
                $sql.="and t.cobrado= 'no' ";
            }
            
            $sql.="and t.fecha BETWEEN '$fecha_desde' "
                . "and '$fecha_hasta' "
                . "GROUP BY o.codigo "
                . "order by turnos desc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    function obtener_listado_agrupado_cobrados($fecha_desde, $fecha_hasta) {
        $sql="SELECT o.razon_social as razon_social, count(c.id_turno) as turnos, round(SUM(c.importe),2) as importe FROM cobro as c, obras_sociales as o where c.id_obra_social=o.codigo and c.fecha BETWEEN '$fecha_desde' and '$fecha_hasta' group by id_obra_social";
        $query = $this->db->query($sql);
        return $query->result_array();
        
    }
    
    function listado_cobros($fecha_desde, $fecha_hasta, $tipo_cobro, $obra_social){
        $sql="select t.codigo as turno, c.fecha as fecha, p.nombre as nombre, p.apellido as apellido, p.dni as dni, c.importe as importe, o.razon_social as obra_social "
                . "from cobro as c, turnos as t, pacientes as p, obras_sociales as o "
                . "where c.id_turno=t.codigo "
                . "and t.paciente=p.dni "
                . "and c.id_obra_social=o.codigo "
                . "and c.fecha BETWEEN '$fecha_desde' "
                . "and '$fecha_hasta' ";
                if($tipo_cobro=='t'){
                    
                }else{
                    $sql.="and c.tipo_cobro in($tipo_cobro) ";
                }
                
                if($obra_social=='t'){
                    
                }else{
                    $sql.="and c.id_obra_social in($obra_social) ";
                }
                
                
                $sql.="order by c.fecha desc";
                $query = $this->db->query($sql);
                return $query->result_array();
    }
    
    function listado_turnos($fecha_desde,$fecha_hasta) {
        $sql="Select t.codigo as turno, t.paciente as dni, t.fecha as fecha, t.hora_desde as h_desde, "
                . "t.hora_hasta as h_hasta, t.cobrado as cobrado, t.importe as importe "
                . "from turnos as t where t.fecha "
                . "BETWEEN '$fecha_desde' and '$fecha_hasta' order by t.codigo desc";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
        
    
    
 }