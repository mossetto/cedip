<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Factura_model
 *
 * @author mario
 */
class Factura_model extends CI_Model
{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function agregarFactura($precio,$paciente,$turno)
    {
        $fecha=Date("Y-m-d");
        $datos = Array(
            "punto"=>"001",
            "tipo"=>"A",
            "cliente"=>$paciente,
            "fecha"=> $fecha,
            "total"=>$precio,
            "turno"=>$turno,
            "estado"=>"a",
        );
        
        return $this->db->insert("factura",$datos);
    }
    
    function getUltimaFactura()
    {
        $r = $this->db->query("select numero from factura where numero in (select max(numero) from factura)");
        return $r->row_array();
    }
}
