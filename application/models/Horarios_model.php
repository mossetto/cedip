<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Horarios_model
 *
 * @author mario
 */
class Horarios_model extends CI_Model
{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    function agregarHorario($profesional,$dia,$hora_desde,$hora_hasta,$tiempo_turno,$vigencia_hasta)
    {
        $datos = Array(
            "profesional"=>$profesional,
            "dia"=>$dia,
            "hora_desde"=>$hora_desde,
            "hora_hasta"=>$hora_hasta,
            "tiempo_turno"=>$tiempo_turno,
            "vigencia_hata"=>$vigencia_hasta,
        );
        
        return $this->db->insert("horarios",$datos);
    }
    
    function obtenerHorariosProfesional($codigo_profesional)
    {
        $result = $this->db->query("SELECT * FROM horarios WHERE horarios.profesional = $codigo_profesional order by vigencia_hasta DESC, dia asc ");
        return $result->result_array();
    }
    
    function getVigencias()
    {
        $result = $this->db->query("select vigencia_hasta from horarios");
        return $result->result_array();
    }
    
    function getHorariosProfesional($profesional,$dia,$anio,$mes)
    {
        $result = $this->db->query("select horarios.codigo,horarios.profesional,horarios.dia,horarios.hora_desde,horarios.hora_hasta,horarios.tiempo_turno, min(horarios.vigencia_hasta) as vigencia_hasta from horarios where horarios.profesional = $profesional and horarios.dia = $dia and vigencia_hasta <= '$anio-$mes-31' and vigencia_hasta >= '$anio-$mes-01'");
        return $result->result_array();
    }
}
